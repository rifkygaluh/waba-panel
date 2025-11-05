<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CollectionHelper;
use App\Http\Helpers\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceVerificationController extends Controller
{
    public function index()
    {
        return inertia('invoice/verification/Index');
    }

    private function queryData(Request $request)
    {
        $stores = DB::table('stores')->select('id', 'name', 'code');
        $users = DB::table('users')->select('id', 'name');
        
        return DB::table('invoices', 'i')
            ->select([
                'i.id', 'i.invoice_number', 'i.amount', 'i.status', 'i.created_at',
                's.name AS store_name', 's.code AS store_code', 'u.name AS user_name',
            ])
            ->joinSub($stores, 's', 's.id', 'i.store_id')
            ->joinSub($users, 'u', 'u.id', 'i.user_id')
            ->where('status', 'pending')
            ->when($request->has('sortField'), function ($query) use ($request) {
                return $query->orderBy($request->sortField, direction: $request->sortOrder === 'descend' ? 'desc' : 'asc');
            }, function ($query) {
                return $query->orderBy('created_at');
            });
    }
    
    public function indexApi(Request $request)
    {
        $perPage = $request->results ?? 10;
                
        return $this->queryData($request)->paginate($perPage);
    }

    public function show(string $id)
    {
        $invoice = DB::table('invoices', 'i')
            ->select('i.*', 'i.media_url AS image')
            ->where('i.id', $id)
            ->firstOrFail();

        $invoice->store = DB::table('stores')->find($invoice->store_id);
        $invoice->user = DB::table('users')->find($invoice->user_id);
        
        return inertia('invoice/verification/Detail', compact('invoice'));
    }
}
