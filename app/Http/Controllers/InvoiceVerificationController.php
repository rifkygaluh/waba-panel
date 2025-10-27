<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceVerificationController extends Controller
{
    public function index()
    {
        return inertia('invoice/verification/Index');
    }

    public function show($id)
    {
        $invoice = [
            'id' => $id,
            'storeName' => fake()->company(),
            'storeOwner' => fake()->name(),
            'storePhone' => fake()->phoneNumber(),
            'storeAddress' => fake()->address(),
            'image' => 'https://picsum.photos/200/300',
            'uploadDate' => now()->subDays(7)->toDateString(),
            'name' => explode(' ', fake()->name())[1],
            'items' => [],
        ];
        
        return inertia('invoice/verification/Detail', compact('invoice'));
    }
}
