<?php

namespace App\Http\Controllers\Fap;

use App\Http\Controllers\Controller;

class FapCabinStatus extends Controller
{
    public function index()
    {
        $therm = new FapTemperature();
        $therm->setTemperature(7,2000);

        return view('cabin-status');
    }
}