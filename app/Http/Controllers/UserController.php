<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_home() 
    {
        return view('User.index');
    }

    public function show_entry_point()
    {
        return view('index');
    }
}
