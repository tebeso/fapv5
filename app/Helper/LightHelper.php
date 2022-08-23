<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use JsonException;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;
use Illuminate\Http\Request;

class LightHelper
{
    /**
     * @throws LazerException
     */
    public static function setState(Request $request): void
    {
        $position = $request->get('position');
        $oldLevel = $request->get('currentLevel');
        $newLevel = $request->get('newLevel');
        $on       = $oldLevel !== $newLevel;

        $light = self::getAssignedLightByPosition($position);

        if ($light['type'] === 'hue') {
            $bridge = new HueHelper();

        } else {
            $bridge = new RaspbeeHelper();
        }

        if ($newLevel === 'BRT') {
            $newLevel = '255';
        } elseif ($newLevel === 'DIM 1') {
            $newLevel = '125';
        } else {
            $newLevel = '50';
        }

        $bridge->setState($light['light_id'], $newLevel, $on);
    }

    /**
     * @return array
     */
    public static function getState(): array
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        $hueLights     = $hue->getLights();
        $raspbeeLights = $raspbee->getLights();

        return [...$hueLights, ...$raspbeeLights];
    }


    /**
     * @throws LazerException
     * @throws JsonException
     */
    public static function getStateAssigned(): JsonResponse
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        $hueLights     = $hue->getLights();
        $raspbeeLights = $raspbee->getLights();

        $allLights      = array_replace($hueLights, $raspbeeLights);
        $assignedLights = [];

        foreach (json_decode(self::getAssignedLights(), true, 512, JSON_THROW_ON_ERROR) as $position => $assignedLight) {

            $light = explode('|', $assignedLight);

            $assignedLights[$position] = $allLights[$light[0]];
        }

        return Response()->json($assignedLights);
    }

    /**
     * @throws LazerException
     */
    public static function assignLight(\Illuminate\Http\Request $request): void
    {
        $position      = $request->get('id');
        $lightsStorage = Lazer::table('lights-storage');

        if ($request->get('selectedValue') === null) {
            $lightsStorage->where('position', '=', $position)->find()->delete();
            return;
        }

        $values = explode('|', $request->get('selectedValue'));

        $lightsId  = $values[0];
        $lightType = $values[1];

        $row = $lightsStorage->where('light_id', '=', $lightsId)->find();

        if ($row->count() > 0) {
            $row->setField('light_id', $lightsId);
            $row->setField('type', $lightType);
            $row->setField('position', $position);
            $row->save();
        } else {
            $lightsStorage->setField('light_id', $lightsId);
            $row->setField('type', $lightType);
            $lightsStorage->setField('position', $position);
            $lightsStorage->save();
        }
    }


    /**
     * @throws LazerException
     */
    public static function getAssignedLightByPosition($position)
    {
        $row = Lazer::table('lights-storage')->where('position', '=', $position)->find();
        if ($row->count() > 0) {
            return $row->asArray()[0];
        }

        return false;
    }

    /**
     * @throws LazerException
     * @throws JsonException
     */
    public static function getAssignedLights(): bool | string
    {
        $assignedLights = [];
        $rows           = Lazer::table('lights-storage')->findAll();

        foreach ($rows as $row) {
            $assignedLights[$row->position] = $row->light_id . '|' . $row->type;
        }

        return json_encode($assignedLights, JSON_THROW_ON_ERROR);
    }
}