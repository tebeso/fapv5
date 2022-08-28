<?php

namespace App\Http\Controllers;

use App\Helper\RaspbeeHelper;
use App\Helper\SensorHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function setState(Request $request): void
    {
        $mode = $request->get('mode');
        $sensorId = $request->get('sensorId');

        $raspbeeHelper = new RaspbeeHelper();
        $sensors = $raspbeeHelper->getSensors();
        $sensor = $sensors[$sensorId];

        if($mode === 'up'){
            $newTarget = $sensor['target'] + 100;
        }
        else{
            $newTarget = $sensor['target'] - 100;
        }

        if($newTarget < 1700){
            $newTarget = 1700;
        }

        if($newTarget > 3000){
            $newTarget = 3000;
        }

        $this->setTemperature($sensorId,$newTarget);
    }

    /**
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