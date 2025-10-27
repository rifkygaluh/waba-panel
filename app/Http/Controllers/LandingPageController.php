<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home(){
        return view('landing-page/home');
    }

    public function about(){
        return view('landing-page/about-us');
    }

    public function faq(){
        return view('landing-page/faq');
    }

    public function terms(){
        return view('landing-page/terms-n-conditions');
    }

    public function privacy(){
        return view('landing-page/privacy-policy');
    }
}
