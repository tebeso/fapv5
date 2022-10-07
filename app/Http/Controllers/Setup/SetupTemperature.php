<?php

namespace App\Http\Controllers\Setup;

use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use App\Http\Controllers\Controller;

class SetupTemperature extends Controller
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