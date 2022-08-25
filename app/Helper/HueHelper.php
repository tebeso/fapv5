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
     * @param $source
     * @param $type
     *
     * @return array
     */
    public function getEntities($source, $type): array
    {
        if ($this->checkConnection() === false) {
            return [];
        }

        $lights = [];

        foreach ($source as $hueLight) {
            $id = (string)$hueLight->getId();

            $lights[$id] = [
                'name'       => '(HUE-' . ucfirst($type) . ') ' . $hueLight->getName(),
                'light_id'   => $id,
                'type'       => 'hue-' . $type,
                'state'      => $hueLight->isOn(),
                'brightness' => $hueLight->getBrightness(),
            ];
        }

        return $lights;
    }


    /**
     * @return array
     */
    public function getLights(): array
    {
        $source = $this->getClient()?->getLights();

        if ($source === null) {
            return [];
        }

        return $this->getEntities($source, 'light');
    }


    /**
     * @return array
     */
    public function getGroups(): array
    {
        $source = $this->getClient()?->getGroups();

        if ($source === null) {
            return [];
        }

        return $this->getEntities($source, 'group');
    }

    /**
     * @param string $type
     *
     * @return array
     */
    public function getSensors(string $type = 'temp'): array
    {
        $sensors = [];

        if ($this->checkConnection() === false) {
            return [];
        }

        $sensorCollection = $this->getClient()?->getSensors();

        if ($sensorCollection === null) {
            return [];
        }
        foreach ($sensorCollection as $id => $sensor) {
            if ($type === 'temp' && isset($sensor->getState()->temperature) === true) {
                $sensors[$id] = [
                    'sensor_id' => $id,
                    'name'      => '(Hue) ' . $sensor->getName() . ' (' . $sensor->getManufacturerName() . ' ' . $sensor->getModelId() . ')',
                    'type'      => 'temp',
                    'hub'       => 'hue',
                    'state'     => MiscHelper::formatTemperature($sensor->getState()->temperature),
                ];
            }
        }

        return $sensors;
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

    public function setState(string $id, string $type, string $level, bool $on): void
    {
        if ($type === 'hue-group') {
            $this->setStateGroup($id, $level, $on);
        } elseif ($type === 'hue-light') {
            $this->setStateLight($id, $level, $on);
        }


    }

    public function setStateLight(string $id, string $level, bool $on): void
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

    public function setStateGroup(string $id, string $level, bool $on): void
    {
        $groups = $this->getClient()?->getGroups();
        if ($groups === null) {
            return;
        }

        $groups[$id]->setOn($on);

        if ($on) {
            $groups[$id]->setBrightness($level);
            $groups[$id]->setSaturation(0);
        } else {
            $groups[$id]->setOn(false);
        }
    }
}