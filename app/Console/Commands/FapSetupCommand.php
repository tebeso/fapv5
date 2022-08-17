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
            } catch (Throwable $e) {
                echo $e->getMessage();
            }

            Lazer::create('audio-storage', [
                'id'             => 'integer',
                'storage_number' => 'string',
                'filename'       => 'string',
            ]);


        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}