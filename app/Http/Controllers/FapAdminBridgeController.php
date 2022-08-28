<?php

namespace App\Http\Controllers;

use App\Helper\EnvHelper;
use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FapAdminBridgeController extends Controller
{
    public function index()
    {
        return view('admin/bridge-setup');
    }


    public function deleteBridge(Request $request): void
    {
        $bridge = $request->get('bridge');

        if ($bridge === 'hue') {
            EnvHelper::setEnv('HUE_IP', '');
            EnvHelper::setEnv('HUE_USER', '');
        } elseif ($bridge === 'raspbee') {
            EnvHelper::setEnv('RASPBEE_IP', '');
            EnvHelper::setEnv('RASPBEE_USER', '');
        }
    }


    public function pairBridge(Request $request)
    {
        $bridge = $request->get('bridge');

        return match ($bridge) {
            'hue'     => $this->pairHueBridge(),
            'raspbee' => $this->pairRaspbeeBridge()
        };
    }


    public function pairHueBridge()
    {
        $hue = new HueHelper();
        $hue->getBridge();
        $user = $hue->getUser();

        if ($user === null) {
            return Response('Couldnt pair bridge.', 500);
        }

        return Response('Bridge paired successfully.');
    }

    public function pairRaspbeeBridge()
    {
        $raspbee = new RaspbeeHelper();
        $user = $raspbee->getUser();

        if ($user === null) {
            return Response('Couldnt pair bridge.', 500);
        }

        return Response('Bridge paired successfully.');
    }


    public function checkPaired(): JsonResponse
    {
        $raspbee     = new RaspbeeHelper();
        $raspbeeUser = $raspbee->getUser();

        $hue     = new HueHelper();
        $hueUser = $hue->getUser();

        return Response()->json(['raspbeeUser' => $raspbeeUser, 'hueUser' => $hueUser]);
    }
}