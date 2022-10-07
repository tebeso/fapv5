<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;

class Setup extends Controller
{
    public function setupSmokeDetect()
    {
        return view('setup.smoke-detection');
    }
}