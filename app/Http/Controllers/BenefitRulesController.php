<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenefitRulesController extends Controller
{
    public function index()
    {
        return inertia('benefit-rules/Index');
    }

    public function create()
    {
        return inertia('benefit-rules/Create');
    }

    public function edit($id)
    {
        $type = ['quantity', 'price'][rand(0, 1)];
        
        $rule = [
            'id' => $id,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => $type,
            'dateRange' => [
                now()->subDays(7)->toDateString(),
                now()->toDateString()
            ],
            'items' => [[
                'productId' => 'Product B',
                'minimumValue' => $type === 'price'
                    ? 50000
                    : 10,
                'benefitPoint' => 50,
                'balanceRollover' => true,
            ]],
        ];
        
        return inertia('benefit-rules/Edit', compact('rule'));
    }
}
