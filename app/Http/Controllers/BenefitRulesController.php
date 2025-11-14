<?php

namespace App\Http\Controllers;

use App\Http\Helpers\APIResponse;
use App\Http\Requests\BenefitRules\StoreRequest;
use App\Http\Requests\BenefitRules\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BenefitRulesController extends Controller
{
    public function index()
    {
        return inertia('benefit-rules/Index');
    }

    private function queryData()
    {
        $ruleProducts = DB::table('benefit_rule_products');
        
        return DB::table('benefit_rules', 'r')
            ->select([
                'r.*', DB::raw('COUNT(rp.id) AS total_products'),
                DB::raw('SUM(rp.benefit) AS total_benefits')
            ])
            ->joinSub($ruleProducts, 'rp', 'rp.rule_id', 'r.id')
            ->orderByDesc('r.id')
            ->groupBy('r.id');
    }
    
    public function indexApi()
    {
        $perPage = $request->results ?? 10;
        
        return $this->queryData()->paginate($perPage);
    }
    
    public function create()
    {
        return inertia('benefit-rules/Create');
    }

    public function store(StoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $ruleId = DB::table('benefit_rules')->insertGetId([
                'name' => $request->name,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            $items = collect($request->items)->map(
                fn ($item) => [...$item, 'rule_id' => $ruleId]
            );
            
            DB::table('benefit_rule_products')->insert($items->toArray());
        });

        return APIResponse::success([
            'message' => 'A benefit rule is successfully created'
        ]);
    }

    public function edit($id)
    {
        $rule = DB::table('benefit_rules', 'r')
            ->select([
                'r.*', DB::raw('DATE(r.start_date) AS start_date'),
                DB::raw('DATE(r.end_date) AS end_date')
            ])
            ->where('r.id', $id)
            ->firstOrFail();
        $rule->items = DB::table('benefit_rule_products')->where('rule_id', $id)->get();
        $rule->period = [$rule->start_date, $rule->end_date];
        
        return inertia('benefit-rules/Edit', compact('rule'));
    }

    public function update($id, UpdateRequest $request)
    {
        $rule = DB::table('benefit_rules')->where('id', $id)->firstOrFail();
        
        DB::transaction(function () use ($request, $rule) {
            DB::table('benefit_rules')->where('id', $rule->id)->update([
                'name' => $request->name,
                'type' => $request->type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            $items = collect($request->items);

            DB::table('benefit_rule_products')
                ->where('rule_id', $rule->id)
                ->whereNotIn('product_id', $items->pluck('product_id'))
                ->delete();
            
            foreach ($items as $item) {
                DB::table('benefit_rule_products')->updateOrInsert([
                    'rule_id' => $rule->id,
                    'product_id' => $item['product_id'],
                ], [
                    'min_value' => $item['min_value'],
                    'benefit' => $item['benefit'],
                    'is_rollover' => $item['is_rollover'],
                ]);
            }
        });

        return APIResponse::success([
            'message' => 'Your benefit rule is successfully updated'
        ]);
    }
}
