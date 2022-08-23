<?php

namespace App\Helper;

use Lazer\Classes\Helpers\Validate;
use Lazer\Classes\LazerException;

class LazerHelper
{
    /**
     * @throws LazerException
     */
    public static function tableExists(string $table): bool
    {
        return Validate::table($table)->exists();
    }
}