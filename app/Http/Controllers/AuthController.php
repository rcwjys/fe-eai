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
                $data = $response->json();
                Session::put('is_admin', $data['user_role'] === 'admin' ? true : false);
                Session::put('isAuthorize', true);
                Session::put('_access_token', $data['accessToken']);
                Session::put('_user_id', $data['user_id']);

                if (Session::get('is_admin') === true) {
                    return view('Admin.index');
                } else {
                    if (Session::get('isAuthorize')) {
                        return redirect(url('/user/dashboard'));
                    } else {
                        return redirect(url('/login'));
                    }
                }
            } else {

                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function show_register_form()
    {
        return view('Authentication.register');
    }

    public function store_register_form(Request $request)
    {
        try {
            $register_validate = $request->validate([
                'username' => 'required|min:3',
                'user_email' => 'required',
                'user_password' => 'required|min:6',
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Session::get('_access_token')
            ])->post('http://localhost:3000/api/v1/users/register', [
                'username' => $register_validate['username'],
                'user_email' => $register_validate['user_email'],
                'user_password' => $register_validate['user_password'],
                'user_attempt' => 1
            ]);

            if ($response->successful()) {
                return back();
            } else {
                dd($response->json());
                return back();
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Session::get('_access_token')
            ])->post('http://localhost:3000/api/v1/users/logout');

            if ($response->successful()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect(url('/'));
            } else {
                if ($response->status() === 403) {
                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json'
                    ])->post('http://localhost:3000/api/v1/users/access-token', [
                        'token' => Session::get('_refresh_token')
                    ]);

                    if ($response->successful()) {
                        $data = $response->json();
                        Session::put('_access_token', $data['accessToken']);
                        Session::put('_refresh_token', $data['refreshToken']);

                        $response = Http::withHeaders([
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . Session::get('_access_token')
                        ])->post('http://localhost:3000/api/v1/users/logout');

                        if ($response->successful()) {
                            $request->session()->invalidate();
                            $request->session()->regenerateToken();
                            return redirect(url('/'));
                        }
                    }
                } else {
                    $request->session()->regenerateToken();
                    return redirect(url('/'));
                }
            }
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }
    }
}
