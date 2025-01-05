<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPKController extends Controller
{
    public function index()
    {
        return view('dpk.home');
    }
}
