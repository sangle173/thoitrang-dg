<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // you can also load featured blogs, villas, etc. later
        return view('home');
    }
}
