<?php

namespace App\Http\Controllers;

use App\Http\Helpers\APIResponse;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function store(StoreRequest $request)
    {
        if (!$request->has('unique_code')) {
            $uniqueCode = strtoupper(Str::random(4))
                . '-' . strtoupper(Str::random(4))
                . '-' . strtoupper(Str::random(4));
        } else {
            $uniqueCode = $request->unique_code;
        }
        
        try {
            DB::table('products')->insert([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'unique_code' => $uniqueCode ?? $request->unique_code,
            ]);
            
            return APIResponse::success([
                'message' => 'Create Success',
                'description' => 'Your product is stored successfully',
            ]);
        } catch (\Throwable $th) {
            return APIResponse::error([
                'message' => 'Create Failed',
                'description' => $th->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $product = DB::table('products')
            ->where('id', $id)
            ->firstOrFail();
        
        return inertia('product/Edit', compact('product'));
    }

    public function update($id, UpdateRequest $request)
    {
        $product = DB::table('products')
            ->where('id', $id)
            ->firstOrFail();

        try {
            DB::table('products')->where('id', $product->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'unique_code' => $request->unique_code,
            ]);
            
            return APIResponse::success([
                'message' => 'Edit Success',
                'description' => 'Your product is updated successfully',
            ]);
        } catch (\Throwable $th) {
            return APIResponse::error([
                'message' => 'Edit Failed',
                'description' => $th->getMessage(),
            ], 500);
        }
    }
}
