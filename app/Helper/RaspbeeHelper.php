<?php

namespace App\Helper;

use App\Interfaces\HubInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Throwable;

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


    /**
     * @return mixed|null
     */
    public function getUser(): mixed
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
            if ($raspbeeLight['type'] !== 'Extended color light') {
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


    /**
     * @return array
     */
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


    /**
     * @param string $type
     *
     * @return array
     */
    public function getSensors(string $type = 'temp'): array
    {
        $sensors = [];

        try {
            $response = Http::get(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/sensors');
        } catch (Throwable $e) {
            return $sensors;
        }

        if ($this->checkConnection() === false || $response->json() === null) {
            return [];
        }

        foreach ($response->json() as $id => $sensor) {
            if ($type === 'temp' && ($sensor['type'] === 'ZHATemperature' || $sensor['type'] === 'ZHAThermostat')) {
                $sensors[$id] = [
                    'sensor_id' => $id,
                    'name'      => '(FAP) ' . $sensor['name'] . ' (' . $sensor['manufacturername'] . ' ' . $sensor['modelid'] . ')',
                    'type'      => $type,
                    'hub'       => 'raspbee',
                    'state'     => $sensor['state']['temperature'],
                    'target'    => isset($sensor['config']['heatsetpoint']) === true ? $sensor['config']['heatsetpoint'] : null,
                ];
            }
            if ($type === 'door' && $sensor['type'] === 'ZHAOpenClose') {
                $sensors[$id] = [
                    'sensor_id' => $id,
                    'name'      => '(FAP) ' . $sensor['name'] . ' (' . $sensor['manufacturername'] . ' ' . $sensor['modelid'] . ')',
                    'type'      => $type,
                    'hub'       => 'raspbee',
                    'state'     => $sensor['state']['open'],
                ];
            }
            if ($type === 'smoke' && $sensor['type'] === 'ZHAFire') {
                $sensors[$id] = [
                    'sensor_id' => $id,
                    'name'      => '(FAP) ' . $sensor['name'] . ' (' . $sensor['manufacturername'] . ' ' . $sensor['modelid'] . ')',
                    'type'      => $type,
                    'hub'       => 'raspbee',
                    'state'     => $sensor['state']['fire'],
                ];
            }
        }

        return $sensors;
    }


    /**
     * @return bool
     */
    public function getClient(): bool
    {
        return false;
    }


    /**
     * @return bool
     */
    public function checkConnection(): bool
    {
        $raspbeePing      = shell_exec('ping -c 1 ' . Env::get('RASPBEE_IP'));
        $raspbeeConnected = str_contains($raspbeePing, '1 received');

        return !(Env::get('HUE_IP') === '' || Env::get('HUE_USER') === '' || $raspbeeConnected === false);
    }


    /**
     * @param string $id
     * @param string $type
     * @param string $level
     * @param bool   $on
     *
     * @return void
     */
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

    public function getAllStates(): JsonResponse
    {
        $response = Http::get(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER'));

        return Response()->json($response);
    }
}