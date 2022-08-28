<?php

namespace App\Http\Controllers;

class FapCabinStatusController extends Controller
{
    public function index()
    {
        $therm = new FapTemperatureController();
        $therm->setTemperature(7,2600);

        return view('cabin-status');
    }
}