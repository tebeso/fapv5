<?php

namespace App\Http\Controllers;

use App\Helper\HueHelper;

class FapTemperatureController extends Controller
{
    public function index()
    {
        $hue = new HueHelper();
        $sensors = $hue->getSensors();

        return view('temperature');
    }
}