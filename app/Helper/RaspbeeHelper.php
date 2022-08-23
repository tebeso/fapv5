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
        if (Env::get('RASPBEE_IP') === '') {
            return null;
        }

        if (Env::get('RASPBEE_USER') !== '') {
            return Env::get('RASPBEE_USER');
        }


        $response = Http::post(Env::get('RASPBEE_IP') . '/api', [
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

        foreach ($response->json() as $raspbeeLight) {
            if ($raspbeeLight['modelid'] === 'RaspBee II') {
                continue;
            }

            $id          = $raspbeeLight['uniqueid'];
            $lights[$id] = [
                'name'       => $raspbeeLight['name'],
                'light_id'   => $id,
                'type'       => 'raspbee',
                'state'      => $raspbeeLight['state']['on'],
                'brightness' => $raspbeeLight['state']['bri'],
            ];
        }
        return $lights;
    }

    public function getSensors()
    {
        // TODO: Implement getSensors() method.
    }

    public function getClient()
    {
        // TODO: Implement getClient() method.
    }

    public function checkConnection()
    {
        // TODO: Implement checkConnection() method.
    }

    public function setState(string $id, string $level, bool $on): void
    {
        Http::put(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/lights/state', [
            'on'             => $on,
            'bri'            => $level,
            'transitiontime' => 0,
            'sat'            => 0,
        ]);
    }
}