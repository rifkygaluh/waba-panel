<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceHistoryController extends Controller
{
    public function index()
    {
        return inertia('invoice/history/Index');
    }

    public function indexApi(Request $request)
    {
        $perPage = $request->results ?? 10;
                
        $stores = DB::table('stores')->select('id', 'name', 'code');
        $users = DB::table('users')->select('id', 'name');
        
        return DB::table('invoices', 'i')
            ->select([
                'i.id', 'i.invoice_number', 'i.amount', 'i.status', 'i.created_at',
                's.name AS store_name', 's.code AS store_code', 'u.name AS user_name',
            ])
            ->joinSub($stores, 's', 's.id', 'i.store_id')
            ->joinSub($users, 'u', 'u.id', 'i.user_id')
            ->where('status', '<>', 'pending')
            ->when($request->has('sortField'), function ($query) use ($request) {
                return $query->orderBy($request->sortField, direction: $request->sortOrder === 'descend' ? 'desc' : 'asc');
            }, function ($query) {
                return $query->orderBy('created_at');
            })
            ->paginate($perPage);
    }
}
