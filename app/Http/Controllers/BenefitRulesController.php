<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BenefitRulesController extends Controller
{
    public function index()
    {
        return inertia('benefit-rules/Index');
    }
}
