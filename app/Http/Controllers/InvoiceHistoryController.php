<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceHistoryController extends Controller
{
    public function index()
    {
        return inertia('invoice/history/Index');
    }
}
