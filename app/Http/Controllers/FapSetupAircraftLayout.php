<?php

namespace App\Http\Controllers;

use App\Helper\EnvHelper;
use Illuminate\Http\Request;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;

class FapSetupAircraftLayout extends Controller
{
    public function index()
    {
        return view('setup/aircraft-layout');
    }

    /**
     * @throws LazerException
     */
    public function changeAircraftLayout(Request $request): void
    {
        $aircraft = $request->get('aircraft');

        Lazer::table('sensors-storage')->delete();
        Lazer::table('lights-storage')->delete();

        EnvHelper::setEnv('AIRCRAFT', $aircraft);
    }
}