<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DPDController extends Controller
{
    public function index()
    {
        return view('dpd.home');
    }
}
