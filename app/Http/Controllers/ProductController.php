<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return inertia('product/Index');
    }

    public function create()
    {
        return inertia('product/Create');
    }

    public function edit($id)
    {
        $product = [
            'id' => $id,
            'name' => "Product $id",
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias ipsam saepe odio nemo veritatis omnis suscipit soluta eligendi explicabo necessitatibus, error quia eos nam, dolorem obcaecati. Quidem fugit minus temporibus.',
            'price' => 50000,
            'uniqueCode' => "000-1111-$id"
        ];
        
        return inertia('product/Edit', compact('product'));
    }
}
