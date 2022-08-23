<?php

namespace App\Helper;

interface HubInterface
{
    /**
     * Returns IP (and port) of Bridge
     *
     * @return string|null
     */
    public function getBridge(): string | null;

    public function getUser();

    public function getLights();

    public function getSensors();

    public function getClient();

    public function checkConnection();

    public function setState(string $id, string $level, bool $on): void;
}