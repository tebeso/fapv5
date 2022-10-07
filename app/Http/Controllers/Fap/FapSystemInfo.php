<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapSystemInfo extends Controller
{
    public function index()
    {
        return view('system-info');
    }
}