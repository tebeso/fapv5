<?php

namespace App\Http\Controllers\Setup;

use App\Helper\RaspbeeHelper;

class SetupDoorsSlides
{


    public function index()
    {
        $doorSensors = $this->getDoorSensors();

        return view('setup.doors-slides', ['doors' => $doorSensors]);
    }


    public function getDoorSensors(): array
    {
        return (new RaspbeeHelper())->getSensors('door');
    }
}