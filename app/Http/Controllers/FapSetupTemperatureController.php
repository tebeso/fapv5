<?php

namespace App\Http\Controllers;

use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use Illuminate\Http\JsonResponse;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;

class FapSetupTemperatureController extends Controller
{
    public function index()
    {
        return view('setup/temperature', ['sensors' => $this->getTemperatureSensors()]);
    }

    public function getTemperatureSensors(): array
    {
        $hue        = new HueHelper();
        $hueSensors = $hue->getSensors();

        $raspbee        = new RaspbeeHelper();
        $raspbeeSensors = $raspbee->getSensors();

        return [...$hueSensors, ...$raspbeeSensors];
    }

    /**
     * @return array
     * @throws LazerException
     */
    public function getAssignedTemperatureSensors(): array
    {
        $sensors = [];
        $rows    = Lazer::table('sensors-storage')->where('type', '=', 'temp')->find();

        foreach ($rows as $row) {
            $sensors[$row->position] = $row->sensor_id;
        }

        return $sensors;
    }
}