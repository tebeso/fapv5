<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;
use JsonException;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;
use Illuminate\Http\Request;
use Throwable;

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

        if ($light === false) {
            return;
        }

        if (in_array($light['type'], ['hue-group', 'hue-light'])) {
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

        $bridge->setState($light['light_id'], $light['type'], $newLevel, $on);
    }

    /**
     * @return array
     */
    public static function getState(): array
    {
        $hue     = new HueHelper();
        $raspbee = new RaspbeeHelper();

        $hueLights = $hue->getLights();
        $hueGroups = $hue->getGroups();

        $raspbeeLights = $raspbee->getLights();
        $raspbeeGroups = $raspbee->getGroups();

        return [...$hueLights, ...$hueGroups, ...$raspbeeLights, $raspbeeGroups];
    }


    /**
     * @throws LazerException
     * @throws JsonException
     */
    public static function getStateAssigned(): JsonResponse
    {
        try {
            $hue       = new HueHelper();
            $hueLights = $hue->getLights();
            $hueGroups = $hue->getGroups();
        } catch (Throwable $e) {
            $hueLights = [];
            $hueGroups = [];
        }

        try {
            $raspbee       = new RaspbeeHelper();
            $raspbeeLights = $raspbee->getLights();
            $raspbeeGroups = $raspbee->getGroups();
        } catch (Throwable $e) {
            $raspbeeLights = [];
            $raspbeeGroups = [];
        }


        $allLights      = [...$hueLights, ...$hueGroups, ...$raspbeeLights, ...$raspbeeGroups];
        $assignedLights = [];

        foreach (json_decode(self::getAssignedLights(), true, 512, JSON_THROW_ON_ERROR) as $position => $assignedLight) {

            $light = explode('|', $assignedLight);

            foreach ($allLights as $allLight) {
                if ((int)$allLight['light_id'] === (int)$light[0] && $allLight['type'] === $light[1]) {
                    $assignedLights[$position] = $allLight;
                }
            }
        }

        return Response()->json($assignedLights);
    }

    /**
     * @throws LazerException
     */
    public static function assignLight(Request $request): void
    {
        $position      = $request->get('id');
        $lightsStorage = Lazer::table('lights-storage');

        if ($request->get('selectedValue') === null) {
            $lightsStorage->where('position', '=', $position)->find()->delete();
            return;
        }

        $values = explode('|', $request->get('selectedValue'));

        $lightsId  = (int)$values[0];
        $lightType = $values[1];

        $row = $lightsStorage->where('position', '=', $position)->find();

        if ($row->count() > 0) {
            $row->setField('light_id', $lightsId);
            $row->setField('type', $lightType);
            $row->setField('position', $position);
            $row->save();
        } else {
            $lightsStorage->setField('light_id', $lightsId);
            $lightsStorage->setField('type', $lightType);
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