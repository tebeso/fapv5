<?php

namespace App\Http\Controllers;

class FapSetupController extends Controller
{
    public function setupDoorsSlides()
    {
        return view('setup/doors-slides');
    }

    public function setupSmokeDetect()
    {
        return view('setup/smoke-detect');
    }
}