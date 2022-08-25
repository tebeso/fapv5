<?php

namespace App\Http\Controllers;

use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use Throwable;

class FapSetupLightsController extends Controller
{
    public function index()
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        try {
            $hue->getBridge();
            $hue->getUser();
            $hueLights = $hue->getLights();
            $hueGroups = $hue->getGroups();
        } catch (Throwable $e) {
            $hueLights = [];
            $hueGroups = [];
        }

        try {
            $raspbee->getBridge();
            $raspbee->getUser();
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