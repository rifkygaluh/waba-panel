<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CollectionHelper;
use App\Http\Helpers\Client;
use Illuminate\Http\Request;

class InvoiceVerificationController extends Controller
{
    public function index()
    {
        return inertia('invoice/verification/Index');
    }

    public function indexApi(Client $client, Request $request)
    {
        $perPage = $request->results ?? 10;
        
        $response = $client->get('api/invoice');
        
        $invoices = collect($response['invoices'])
            ->where('status', 'pending')
            ->when($request->has('sortField'), function ($item) use ($request) {
                return $item->sortBy($request->sortField, descending: $request->sortOrder === 'descend');
            }, function ($item) {
                return $item->sortBy('created_at');
            })
            ->values();

        return CollectionHelper::paginate($invoices, $perPage);
    }

    public function show($id, Client $client)
    {
        $response = $client->get("api/invoice/$id");
        
        $invoice = collect($response['invoice']);
        
        return inertia('invoice/verification/Detail', compact('invoice'));
    }
}
