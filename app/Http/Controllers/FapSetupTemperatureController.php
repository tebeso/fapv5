<?php

namespace App\Http\Controllers;

use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;

class FapSetupTemperatureController extends Controller
{
    public function index()
    {
        return view('setup/temperature', ['sensors' => $this->getTemperatureSensors()]);
    }

    public function getTemperatureSensors(): array
    {
        $hue        = new HueHelper();
        $hueSensors = $hue->getSensors();

        $raspbee        = new RaspbeeHelper();
        $raspbeeSensors = $raspbee->getSensors();

        return [...$hueSensors, ...$raspbeeSensors];
    }
}