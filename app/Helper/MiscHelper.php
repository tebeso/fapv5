<?php

namespace App\Helper;

class MiscHelper
{
    /**
     * @param $temperature
     *
     * @return string
     */
    public static function formatTemperature($temperature): string
    {
        return substr($temperature, 0, 2) . '.' . substr($temperature, 2, 1);
    }
}