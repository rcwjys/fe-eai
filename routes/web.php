<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/login', [AuthController::class, 'show_login_form']);
Route::post('/login', [AuthController::class, 'store_login_credentials']);


Route::get('/user/dashboard', [UserController::class, 'show_home']);





//Test FE
Route::get('user/aspiration/create', function () {
    return view('aspiration.create');
});
