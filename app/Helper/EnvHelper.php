<?php

namespace App\Helper;

use Illuminate\Support\Env;

class EnvHelper
{
    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public static function setEnv(string $key, string $value): void
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . Env::get($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
}