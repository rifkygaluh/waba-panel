<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('auth/Login');
    }
    
    public function store(Request $request)
    {
        $baseUrl = env('API_URL');

        $loginResponse = Http::post("$baseUrl/auth/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($loginResponse->getStatusCode() === 200) {
            $token = $loginResponse['token'];

            $userResponse = Http::withHeader('Authorization', "Bearer $token")
                ->get("$baseUrl/api/me");

            session([
                'user' => $userResponse->json(),
                'token' => $token,
            ]);

            return redirect()->to('dashboard');
        } else if ($loginResponse->getStatusCode() === 401) {
            return back()->withErrors([
                'auth' => 'The credential does not match our records'
            ]);
        }
    }

    public function destroy()
    {
        session()->flush();

        return redirect()->to('login');
    }
}
