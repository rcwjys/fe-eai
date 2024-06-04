<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show_index_page() 
    {
        return view('Admin.index');
    }
}
