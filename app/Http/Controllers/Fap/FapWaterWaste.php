<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapWaterWaste extends Controller
{
    public function index()
    {
        return view('water-waste');
    }
}