<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function show_login_form() 
    {
        return view('Authentication.login');
    }

    public function store_login_credentials(Request $request)
    {
        try {
            $validate_credentials = $request->validate([
                'username' => 'required', 
                'user_password' => 'required'
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])->post('http://localhost:3000/api/v1/users/login', [
                'username' => $validate_credentials['username'],
                'user_password' => $validate_credentials['user_password']
            ]);

            if ($response->successful()) {
                Session::put('isAuthorize', true);
                $data = $response->json();
                
                return redirect(url('/user/dashboard'));
            } else {
                return back();
            }

        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}
