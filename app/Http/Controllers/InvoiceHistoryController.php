<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Client;
use App\Http\Helpers\CollectionHelper;
use Illuminate\Http\Request;

class InvoiceHistoryController extends Controller
{
    public function index()
    {
        return inertia('invoice/history/Index');
    }

    public function indexApi(Client $client, Request $request)
    {
        $perPage = $request->results ?? 10;
        
        $response = $client->get('api/invoice');
        
        $invoices = collect($response['invoices'])
            ->where('status', '<>', 'pending')
            ->when($request->has('sortField'), function ($item) use ($request) {
                return $item->sortBy($request->sortField, descending: $request->sortOrder === 'descend');
            }, function ($item) {
                return $item->sortBy('created_at');
            })
            ->values();

        return CollectionHelper::paginate($invoices, $perPage);
    }
}
