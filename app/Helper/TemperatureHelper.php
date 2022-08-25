<?php

namespace App\Helper;

use JsonException;
use Lazer\Classes\Database as Lazer;
use Lazer\Classes\LazerException;

class TemperatureHelper
{
    /**
     * @throws LazerException
     * @throws JsonException
     */
    public static function getAssignedTemperatures(): bool | string
    {
        $assignedLights = [];
        $rows           = Lazer::table('sensors-storage')->findAll();

        foreach ($rows as $row) {
            $assignedLights[$row->position] = $row->light_id . '|' . $row->type;
        }

        return json_encode($assignedLights, JSON_THROW_ON_ERROR);
    }
}