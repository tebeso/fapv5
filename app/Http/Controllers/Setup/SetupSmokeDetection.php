<?php

namespace App\Http\Controllers\Setup;

use App\Helper\RaspbeeHelper;

class SetupSmokeDetection
{
    public function index()
    {
        return view('setup/smoke-detection', ['sensors' => $this->getSmokeDetectSensors()]);
    }

    public function getSmokeDetectSensors(): array
    {
        return (new RaspbeeHelper())->getSensors('smoke');
    }
}