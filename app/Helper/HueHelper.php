<?php

namespace App\Helper;

use Illuminate\Support\Env;
use Phue\Client;
use Throwable;

class HueHelper implements HubInterface
{
    /**
     * @var Client|null
     */
    public ?Client $client = null;

    /**
     * @return string|null
     */
    public function getBridge(): string | null
    {
        if (Env::get('HUE_IP') !== '') {
            return Env::get('HUE_IP');
        }

        $getBridgeInfo     = shell_exec('../vendor/neoteknic/phue/bin/phue-bridge-finder');
        $getBridgeInfoRows = explode(PHP_EOL, $getBridgeInfo);

        try {
            $bridgeIpAddress = str_replace('Internal IP Address: ', '', trim(preg_replace('/\t+/', '', $getBridgeInfoRows[8])));
        } catch (Throwable $e) {
            return $e->getMessage();
        }

        if (Env::get('HUE_IP') === '') {
            EnvHelper::setEnv('HUE_IP', $bridgeIpAddress);
        }

        return $bridgeIpAddress;
    }

    /**
     * @return mixed
     */
    public function getUser(): mixed
    {
        if (Env::get('HUE_IP') === '') {
            return null;
        }

        if (Env::get('HUE_USER') !== '') {
            $user = Env::get('HUE_USER');
        } else {
            $createUser = explode(PHP_EOL, shell_exec('../vendor/neoteknic/phue/bin/phue-create-user ' . Env::get('HUE_IP')));

            /**
             * If array has only 4 items, it means it didn't create the user.
             * Probably because of a timeout (user didn't push the Hue Bridge button in time)
             */
            if (count($createUser) === 4) {
                return null;
            }

            try {
                $user = str_replace('Successfully created new user: ', '', trim(preg_replace('/\t+/', '', $createUser[5])));
            } catch (Throwable $e) {
                return $e->getMessage();
            }

            EnvHelper::setEnv('HUE_USER', $user);
        }

        return $user;
    }

    /**
     * @return array|null
     */
    public function getLights(): ?array
    {
        if ($this->checkConnection() === false) {
            return null;
        }

        $lights = [];

        foreach ($this->getClient()?->getLights() as $hueLight) {
            $id = (string)$hueLight->getId();

            $lights[$id] = [
                'name'       => $hueLight->getName(),
                'light_id'   => $id,
                'type'       => 'hue',
                'state'      => $hueLight->isOn(),
                'brightness' => $hueLight->getBrightness(),
            ];
        }

        return $lights;
    }

    /**
     * Currently only supports temperature sensors.
     *
     * @param string $type
     *
     * @return array|null
     */
    public function getSensors(string $type = 'temperature'): ?array
    {
        if ($this->checkConnection() === false) {
            return null;
        }

        return $this->getClient()?->getSensors();
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        if (Env::get('HUE_IP') === '' || Env::get('HUE_USER') === '') {
            return null;
        }

        if ($this->client === null) {
            $this->client = new Client(Env::get('HUE_IP'), Env::get('HUE_USER'));
        }

        return $this->client;
    }

    /**
     * @return bool
     */
    public function checkConnection(): bool
    {
        return !($this->getClient() === null || Env::get('HUE_IP') === '' || Env::get('HUE_USER') === '');
    }

    public function setState(string $id, string $level, bool $on): void
    {
        $lights = $this->getClient()?->getLights();
        if ($lights === null) {
            return;
        }

        $lights[$id]->setOn($on);

        if ($on) {
            $lights[$id]->setBrightness($level);
            $lights[$id]->setSaturation(0);
        } else {
            $lights[$id]->setOn(false);
        }
    }
}