<?php

namespace App\Http\Controllers;

class FapSetupController extends Controller
{
    public function setupAudio()
    {
        return view('setup/audio');
    }

    public function setupLights()
    {
        return view('setup/lights');
    }

    public function setupDoorsSlides()
    {
        return view('setup/doors-slides');
    }

    public function setupTemperature()
    {
        return view('setup/temperature');
    }

    public function setupSmokeDetect()
    {
        return view('setup/smoke-detect');
    }

    public function setupAircraftLayout()
    {
        return view('setup/aircraft-layout');
    }
}