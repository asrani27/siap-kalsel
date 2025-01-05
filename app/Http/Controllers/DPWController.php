<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPWController extends Controller
{
    public function index()
    {
        return view('dpw.home');
    }
}
