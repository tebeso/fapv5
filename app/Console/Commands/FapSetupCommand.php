<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Lazer\Classes\Database as Lazer;
use Throwable;

class FapSetupCommand extends Command
{
    protected $signature = 'fap:setup';

    protected $description = 'Installs everything needed for the FAP to run.';

    public function handle(): void
    {
        try {
            try {
                Lazer::remove('audio-storage');
                Lazer::remove('lights-storage');
                Lazer::remove('sensors-storage');
            } catch (Throwable $e) {
                echo $e->getMessage();
            }

            Lazer::create('audio-storage', [
                'id'             => 'integer',
                'storage_number' => 'string',
                'filename'       => 'string',
            ]);


            Lazer::create('lights-storage', [
                'id'       => 'integer',
                'light_id' => 'string',
                'type'     => 'string',
                'position' => 'string',
            ]);

            Lazer::create('sensors-storage', [
                'id'        => 'integer',
                'sensor_id' => 'integer',
                'type'     => 'string',
                'position'  => 'string',
            ]);

        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
