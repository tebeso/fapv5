<?php

namespace App\Http\Controllers;

use App\Helper\SensorHelper;
use Illuminate\Http\JsonResponse;
use JsonException;
use Lazer\Classes\LazerException;

class FapTemperatureController extends Controller
{
    public function index()
    {
        return view('temperature');
    }

    /**
     * @throws LazerException
     * @throws JsonException
     */
    public function getStateAssigned(): JsonResponse
    {
        return SensorHelper::getStateAssigned('temp');
    }
}