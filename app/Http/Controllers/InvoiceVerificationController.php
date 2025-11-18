<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Invoice\AcceptRequest;
use App\Http\Requests\Invoice\RejectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceVerificationController extends Controller
{
    public function index()
    {
        return inertia('invoice/verification/Index');
    }

    private function queryData(Request $request, $selects = [])
    {
        $stores = DB::table('stores');
        $users = DB::table('users');
        
        return DB::table('invoices', 'i')
            ->select([
                'i.id', 'i.invoice_number', 'i.amount', 'i.status', 'i.created_at',
                's.name AS store_name', 's.code AS store_code', 'u.name AS user_name',
                ...$selects
            ])
            ->joinSub($stores, 's', 's.id', 'i.store_id')
            ->joinSub($users, 'u', 'u.id', 'i.user_id')
            ->when($request->has('sortField'), function ($query) use ($request) {
                return $query->orderBy($request->sortField, direction: $request->sortOrder === 'descend' ? 'desc' : 'asc');
            }, function ($query) {
                return $query->orderBy('invoice_number');
            });
    }
    
    public function indexApi(Request $request)
    {
        $perPage = $request->results ?? 10;
                
        return $this->queryData($request)
            ->where('i.status', 'pending')
            ->paginate($perPage);
    }

    public function checkDuplicateApi(Request $request)
    {
        $perPage = $request->results ?? 5;
                
        return $this->queryData($request, [
                'i.amount', 'i.total_pieces', DB::raw('DATE(i.created_at) AS date'),
                'i.media_url AS image', 's.area AS store_area', 'u.email AS user_email',
                'u.phone_number AS user_phone_number', 'u.address AS user_address',
            ])
            ->where('i.id', '<>', $request->id)
            ->where('i.status', 'accepted')
            ->where('i.amount', $request->amount)
            ->where('i.total_pieces', $request->total_pieces)
            ->whereDate('i.created_at', $request->date)
            ->paginate($perPage);
    }

    public function show(string $id)
    {
        $invoice = DB::table('invoices', 'i')
            ->select('i.*', 'i.media_url AS image')
            ->where('i.id', $id)
            ->firstOrFail();

        $invoice->store = DB::table('stores')->find($invoice->store_id);
        $invoice->user = DB::table('users')->find($invoice->user_id);
        $invoice->items = DB::table('invoice_products')
            ->select('product_id', 'qty AS quantity', 'price')
            ->where('invoice_id', $id)
            ->get();
        
        return inertia('invoice/verification/Detail', compact('invoice'));
    }

    private function validate(Request $request)
    {
        $invoice = DB::table('invoices')
            ->where('id', $request->id)
            ->first();

        if ($invoice->status !== 'pending') return (object)[
            'error' => 'Invoice has been verified before',
            'status' => 400,
        ];
        
        return $invoice;
    }

    public function accept(AcceptRequest $request)
    {
        $data = $this->validate($request);

        if (isset($data->error)) return APIResponse::error([
            'message' => 'Verification Failed',
            'description' => $data->error,
        ], $data->status);

        DB::transaction(function () use ($data, $request) {
            DB::table('invoices')->where('id', $data->id)->update([
                'status' => 'accepted',
                'date' => $request->invoice_date,
                'total_pieces' => $request->total_pieces,
                'amount' => $request->amount,
                'verified_at' => now()->toDateTimeString(),
            ]);

            DB::table('invoice_products')
                ->where('invoice_id', $data->id)
                ->delete();
            
            foreach ($request->items as $item) {
                DB::table('invoice_products')->insert([
                    'invoice_id' => $data->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'],
                    'discount' => $item['discount'] ?? NULL,
                    'discount_type' => $item['discount_type'],
                    'price' => $item['price'],
                ]);
            }
        });

        // TODO: Handle generate benefit
        // TODO: Handle trigger notification

        return APIResponse::success([
            'message' => 'Verification Success',
            'description' => 'Invoice has been accepted',
        ]);
    }

    public function reject(RejectRequest $request)
    {
        $data = $this->validate($request);

        if (isset($data->error)) return APIResponse::error([
            'message' => 'Verification Failed',
            'description' => $data->error,
        ], $data->status);

        DB::transaction(function () use ($data, $request) {
            DB::table('invoices')->where('id', $data->id)->update([
                'status' => 'rejected',
                'comments' => $request->comments,
                'date' => $request->invoice_date,
                'total_pieces' => $request->total_pieces,
                'amount' => $request->amount,
                'verified_at' => now()->toDateTimeString(),
            ]);

            DB::table('invoice_products')
                ->where('invoice_id', $data->id)
                ->delete();
            
            foreach ($request->items as $item) {
                DB::table('invoice_products')->insert([
                    'invoice_id' => $data->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['quantity'],
                    'discount' => $item['discount'] ?? NULL,
                    'discount_type' => $item['discount_type'],
                    'price' => $item['price'],
                ]);
            }
        });

        // TODO: Handle trigger notification
        
        return APIResponse::success([
            'message' => 'Verification Success',
            'description' => 'Invoice has been rejected',
        ]);
    }
}
