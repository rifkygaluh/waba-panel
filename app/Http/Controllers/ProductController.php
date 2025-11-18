<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('product/Index');
    }

    public function indexApi()
    {
        $perPage = $request->results ?? 10;
        
        return DB::table('products')
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function optionsApi()
    {
        return DB::table('products')
            ->select('name AS label', 'id AS value')
            ->get();
    }

    public function create()
    {
        return inertia('product/Create');
    }

    public function edit($id)
    {
        $product = DB::table('products')->find($id);
        
        return inertia('product/Edit', compact('product'));
    }
}
