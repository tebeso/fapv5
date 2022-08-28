<?php

namespace App\Http\Controllers;

use App\Helper\SensorHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
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

    public function setTemperature(string $sensorId, int $temperature): void
    {
        $url = Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/sensors/' . $sensorId . '/config';

        Http::put($url, [
            'heatsetpoint' => $temperature,
        ]);
    }
}