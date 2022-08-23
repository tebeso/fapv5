<?php

namespace App\Http\Controllers;

use App\Helper\HueHelper;
use App\Helper\LightHelper;
use App\Helper\RaspbeeHelper;
use Lazer\Classes\LazerException;

class FapSetupLightsController extends Controller
{
    /**
     * @throws LazerException
     */
    public function index()
    {
        $hue = new HueHelper();
        $hue->getBridge();
        $hue->getUser();
        $hue->getClient();
        $hueLights  = $hue->getLights();
        $hueSensors = $hue->getSensors();

        $raspbee = new RaspbeeHelper();
        $raspbee->getBridge();
        $raspbee->getUser();
        $raspbee->getClient();
        $raspbeeLights  = $raspbee->getLights();
        $raspbeeSensors = $raspbee->getSensors();



        $lights = [...$hue->getLights(), ...$raspbee->getLights()];
        sort($lights);

        return view('setup/lights', ['lights' => $lights]);
    }
}