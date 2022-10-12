<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Lazer\Classes\Database as Lazer;
use Throwable;

class FapSetupCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'fap:setup';

    /**
     * @var string
     */
    protected $description = 'Installs everything needed for the FAP to run.';

    /**
     * @var array|string[][]
     */
    protected array $tables = [
        'audio-storage'   => [
            'id'             => 'integer',
            'storage_number' => 'string',
            'filename'       => 'string',
        ],
        'lights-storage'  => [
            'id'       => 'integer',
            'light_id' => 'integer',
            'type'     => 'string',
            'hub'      => 'string',
            'position' => 'string',
        ],
        'sensors-storage' => [
            'id'        => 'integer',
            'sensor_id' => 'integer',
            'type'      => 'string',
            'hub'       => 'string',
            'position'  => 'string',
        ],
    ];

    /**
     * @return void
     */
    public function handle(): void
    {
        $errors = [];

        foreach ($this->getTables() as $table => $tableData) {
            try {
                Lazer::remove($table);
            } catch (Throwable $e) {
                $errors[] = $table . ': ' . $e->getMessage();
            }
        }

        foreach ($this->getTables() as $table => $tableData) {
            try {
                Lazer::create($table, $tableData);
            } catch (Throwable $e) {
                $errors[] = $table . ': ' . $e->getMessage();
            }
        }

        if (empty($errors) === false) {
            /** @noinspection ForgottenDebugOutputInspection */
            dd($errors);
        } else {
            echo "Setup complete.";
        }
    }

    /**
     * @return array
     */
    public function getTables(): array
    {
        return $this->tables;
    }


}
