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
            'name' => explode(' ', fake()->name())[1],
            'uploadDate' => now()->subDays(7)->toDateString(),
            'items' => [],
        ];
        
        return inertia('invoice/verification/Detail', compact('invoice'));
    }
}
