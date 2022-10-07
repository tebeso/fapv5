<?php

namespace App\Http\Controllers\Setup;

use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use App\Http\Controllers\Controller;
use Throwable;

class SetupLights extends Controller
{
    public function index()
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        try {
            $hueLights = $hue->getLights();
            $hueGroups = $hue->getGroups();
        } catch (Throwable $e) {
            $hueLights = [];
            $hueGroups = [];
        }

        try {
            $raspbeeLights = $raspbee->getLights();
            $raspbeeGroups = $raspbee->getGroups();
        } catch (Throwable $e) {
            $raspbeeLights = [];
            $raspbeeGroups = [];
        }

        $lights = [...$hueLights, ...$hueGroups, ...$raspbeeLights, ...$raspbeeGroups];
        sort($lights);

        return view('setup/lights', ['lights' => $lights]);
    }
}