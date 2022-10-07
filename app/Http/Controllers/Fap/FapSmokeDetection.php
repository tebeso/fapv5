<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapSmokeDetection extends Controller
{
    public function index()
    {
        return view('smoke-detection');
    }
}