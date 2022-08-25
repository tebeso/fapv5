<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;

class SensorHelper
{
    /**
     * @param string $type
     *
     * @return JsonResponse
     * @throws JsonException
     * @throws LazerException
     */
    public static function getStateAssigned(string $type): JsonResponse
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        $hueSensors      = $hue->getSensors($type);
        $raspbeeSeonsors = $raspbee->getSensors($type);

        $allSensors      = [...$hueSensors, ...$raspbeeSeonsors];
        $assignedSensors = [];

        $request = Request::create('', 'GET', ['type' => $type]);

        foreach (json_decode(self::getAssignedSensors($request), true, 512, JSON_THROW_ON_ERROR) as $position => $assignedSensor) {

            $sensor = explode('|', $assignedSensor);

            foreach ($allSensors as $singleSensor) {
                if ((int)$singleSensor['sensor_id'] === (int)$sensor[0] && $singleSensor['type'] === $sensor[1] && $singleSensor['hub'] === $sensor[2]) {
                    $assignedSensors[$position] = $singleSensor;
                    break;
                }
            }
        }

        return Response()->json($assignedSensors);
    }


    /**
     * @throws LazerException
     */
    public static function assignSensor(Request $request): void
    {
        $position   = $request->get('id');

        $sensorStorage = Lazer::table('sensors-storage');

        if ($request->get('selectedValue') === null) {
            $sensorStorage->where('position', '=', $position)->find()->delete();
            return;
        }

        $selectedValue = explode('|', $request->get('selectedValue'));
        $sensorId      = (int)$selectedValue[0];
        $type          = $selectedValue[1];
        $hub           = $selectedValue[2];

        $row = $sensorStorage->where('position', '=', $position)->where('type', '=', $type)->find();

        if ($row->count() > 0) {
            $row->setField('sensor_id', $sensorId);
            $row->setField('type', $type);
            $row->setField('hub', $hub);
            $row->setField('position', $position);
            $row->save();
        } else {
            $sensorStorage->setField('sensor_id', $sensorId);
            $sensorStorage->setField('type', $type);
            $sensorStorage->setField('hub', $hub);
            $sensorStorage->setField('position', $position);
            $sensorStorage->save();
        }
    }


    /**
     * @param Request $request
     *
     * @return false|string
     * @throws JsonException
     * @throws LazerException
     */
    public static function getAssignedSensors(Request $request): bool | string
    {
        $sensorType = $request->get('type');

        $sensors = [];
        $rows    = Lazer::table('sensors-storage')->where('type', '=', $sensorType)->findAll();

        foreach ($rows as $row) {
            $sensors[$row->position] = $row->sensor_id . '|' . $row->type . '|' . $row->hub;
        }

        return json_encode($sensors, JSON_THROW_ON_ERROR);
    }
}