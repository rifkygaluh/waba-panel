<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BenefitCalculation
{
    private static function getInvoiceItems($invoice)
    {
        $benefitRules = DB::table('benefit_rules')
            ->whereDate('start_date', '<=', $invoice->date)
            ->whereDate('end_date', '>=', $invoice->date);

        $benefitRuleProducts = DB::table('benefit_rule_products');

        $invoices = DB::table('invoices');
        
        return DB::table('invoice_products', 'ip')
            ->selectRaw("i.id AS invoice_id, rp.rule_id, r.type AS rule_type,
                rp.min_value, rp.benefit, rp.is_rollover, rp.id AS benefit_product_id,
                SUM(ip.qty) AS total_pieces, SUM(ip.total_price) AS total_price, i.user_id")
            ->joinSub($invoices, 'i', 'i.id', 'ip.invoice_id')
            ->joinSub($benefitRuleProducts, 'rp', 'rp.product_id', 'ip.product_id')
            ->joinSub($benefitRules, 'r', 'r.id', 'rp.rule_id')
            ->where('invoice_id', $invoice->id)
            ->groupBy('i.id', 'rp.rule_id', 'rule_type', 'rp.min_value',
                'rp.benefit', 'rp.is_rollover', 'benefit_product_id', 'i.user_id')
            ->orderBy('rp.rule_id')
            ->get();
    }

    private static function calculateRollover($item, $value)
    {
        $lastBenefit = DB::table('benefit_logs')
            ->where('user_id', $item->user_id)
            ->where('benefit_product_id', $item->benefit_product_id)
            ->orderByDesc('id')
            ->first();

        if ($lastBenefit?->rollover_value) {
            $value = $value + $lastBenefit->rollover_value;
        }

        $rollover = $value >= $item->min_value
            ? $value % $item->min_value
            : $value;
            
        return compact(['value', 'rollover']);
    }
    
    private static function calculatePoint($item)
    {
        $value = 0;
        $rollover = null;
        $benefit = null;
        
        if ($item->rule_type === 'quantity') $value = $item->total_pieces;
        else if ($item->rule_type === 'price') $value = $item->total_price;
        
        if ($value > 0) {
            if ($item->is_rollover) {
                ['value' => $value, 'rollover' => $rollover] = self::calculateRollover(
                    $item,
                    $value,
                );
            }
            
            $benefit = $value >= $item->min_value
                ? (int)($value / $item->min_value) * $item->benefit
                : 0;
        }

        return (object)compact(['benefit', 'rollover']);
    }

    private static function saveCalculatedPoints($item, $calculated)
    {
        $userPoint = DB::table('user_points')
            ->where('user_id', $item->user_id)
            ->where('periode', now()->year)
            ->first();
        
        if ($userPoint) {
            DB::table('user_points')->where('user_id', $item->user_id)->update([
                'total_point' => $userPoint->total_point + $calculated->benefit,
                'balance_point' => $userPoint->balance_point + $calculated->benefit,
            ]);
        } else {
            $userPointId = DB::table('user_points')->insertGetId([
                'user_id' => $item->user_id,
                'periode' => now()->year,
                'total_point' => $calculated->benefit,
                'balance_point' => $calculated->benefit,
            ]);
            $userPoint = DB::table('user_points')->find($userPointId);
        }

        DB::table('benefit_logs')->insert([
            'user_id' => $item->user_id,
            'invoice_id' => $item->invoice_id,
            'benefit_product_id' => $item->benefit_product_id,
            'value' => $calculated->benefit,
            'rollover_value' => $calculated->rollover,
        ]);

        DB::table('point_logs')->insert([
            'user_id' => $item->user_id,
            'periode' => $userPoint->periode,
            'type' => 'invoice',
            'reference_id' => $item->invoice_id,
            'point' => $calculated->benefit,
        ]);
    }

    public static function storeBenefit($invoice, Request $request)
    {
        $invoice->date = $request->invoice_date;
        $invoiceItems = self::getInvoiceItems($invoice);
        
        $totalPoints = 0;
        
        foreach ($invoiceItems as $item) {
            $calculated = self::calculatePoint($item);
            self::saveCalculatedPoints($item, $calculated);
            $totalPoints += $calculated->benefit;
        }

        return $totalPoints;
    }
}
