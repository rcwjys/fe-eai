<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function show_entry_point()
    {
        return view('Guest.index');
    }
}
