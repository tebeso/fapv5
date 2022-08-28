<?php

namespace App\Helper;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class RaspbeeHelper implements HubInterface
{

    /**
     * @return null|string
     */
    public function getBridge(): null | string
    {
        if (Env::get('RASPBEE_IP') !== '') {
            return Env::get('RASPBEE_IP');
        }

        $response        = Http::get('https://phoscon.de/discover');
        $bridgeIpAddress = null;

        if (isset($response->json()[0]['internalipaddress']) === true) {
            $bridgeIpAddress = $response->json()[0]['internalipaddress'];
            EnvHelper::setEnv('RASPBEE_IP', $bridgeIpAddress);
        }

        return $bridgeIpAddress;
    }

    public function getUser()
    {
        $bridge = $this->getBridge();

        if ($bridge === '') {
            return null;
        }

        if (Env::get('RASPBEE_USER') !== '') {
            return Env::get('RASPBEE_USER');
        }


        $response = Http::post($bridge . '/api', [
            'devicetype' => 'FAP',
        ]);

        if ($response->status() !== 403 && isset($response->json()[0]['success']['username']) === true) {
            $user = $response->json()[0]['success']['username'];
            EnvHelper::setEnv('RASPBEE_USER', $user);

            return $user;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getLights(): array
    {
        $response = Http::get(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/lights');
        $lights   = [];

        foreach ($response->json() as $id => $raspbeeLight) {
            if ($raspbeeLight['modelid'] === 'RaspBee II') {
                continue;
            }

            $lights[$id] = [
                'name'       => '(FAP-Light) ' . $raspbeeLight['name'],
                'light_id'   => $id,
                'type'       => 'raspbee-light',
                'state'      => $raspbeeLight['state']['on'],
                'brightness' => $raspbeeLight['state']['bri'],
            ];
        }
        return $lights;
    }

    public function getGroups(): array
    {
        $response = Http::get(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/groups');
        $groups   = [];

        foreach ($response->json() as $group) {
            $id     = $group['id'];
            $lights = $this->getLights();

            if (empty($lights) === false) {
                $groups[$id] = [
                    'name'       => '(FAP-Group) ' . $group['name'],
                    'light_id'   => $id,
                    'type'       => 'raspbee-group',
                    'state'      => $group['state']['any_on'],
                    'brightness' => $lights[$group['lights'][0]]['brightness'],
                ];
            }
        }

        return $groups;
    }


    public function getSensors($type = 'temp'): array
    {
        $response = Http::get(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/sensors');
        $sensors  = [];


        foreach ($response->json() as $id => $sensor) {

            if ($type === 'temp' && ($sensor['type'] === 'ZHATemperature' || $sensor['type'] === 'ZHAThermostat')) {
                $sensors[$id] = [
                    'sensor_id' => $id,
                    'name'      => '(FAP) ' . $sensor['name'] . ' (' . $sensor['manufacturername'] . ' ' . $sensor['modelid'] . ')',
                    'type'      => 'temp',
                    'hub'       => 'raspbee',
                    'state'     => $sensor['state']['temperature'],
                    'target'    => isset($sensor['config']['heatsetpoint']) === true ? $sensor['config']['heatsetpoint'] : null,
                ];
            }
        }

        return $sensors;
    }

    public function getClient()
    {
        // TODO: Implement getClient() method.
    }

    public function checkConnection()
    {
        // TODO: Implement checkConnection() method.
    }

    public function setState(string $id, string $type, string $level, bool $on): void
    {
        if ($type === 'raspbee-group') {
            $this->setStateGroup($id, $level, $on);
        } elseif ($type === 'raspbee-light') {
            $this->setStateLight($id, $level, $on);
        }
    }

    public function setStateLight(string $id, string $level, bool $on): void
    {
        $url = 'http://' . Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/lights/' . $id . '/state';

        Http::put($url, [
            'on'             => $on,
            'bri'            => (int)$level,
            'transitiontime' => 0,
        ]);
    }

    public function setStateGroup(string $id, string $level, bool $on): void
    {
        $url = 'http://' . Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/groups/' . $id . '/action';

        Http::put($url, [
            'on'             => $on,
            'bri'            => (int)$level,
            'transitiontime' => 0,
        ]);
    }
}