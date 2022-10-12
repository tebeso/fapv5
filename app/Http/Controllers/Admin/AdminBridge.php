<?php

namespace App\Http\Controllers\Admin;

use App\Helper\EnvHelper;
use App\Helper\HueHelper;
use App\Helper\RaspbeeHelper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;

class AdminBridge extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin/bridge-setup', ['serverIp' => $_SERVER['SERVER_ADDR']]);
    }


    /**
     * @return Application|ResponseFactory|Response
     */
    public function pairRaspbeeDevices()
    {
        Http::put(Env::get('RASPBEE_IP') . '/api/' . Env::get('RASPBEE_USER') . '/config', [
            'permitjoin' => 60,
        ]);

        return Response('Pairing Mode enabled. Please turn on the device you want to pair within 60 seconds.');
    }


    /**
     * @param Request $request
     *
     * @return void
     */
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


    /**
     * @param Request $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function pairBridge(Request $request)
    {
        $bridge = $request->get('bridge');

        return match ($bridge) {
            'hue'     => $this->pairHueBridge(),
            'raspbee' => $this->pairRaspbeeBridge()
        };
    }


    /**
     * @return Application|ResponseFactory|Response
     */
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


    /**
     * @return Application|ResponseFactory|Response
     */
    public function pairRaspbeeBridge()
    {
        $raspbee = new RaspbeeHelper();
        $user    = $raspbee->getUser();

        if ($user === null) {
            return Response('Couldnt pair bridge.', 500);
        }

        return Response('Bridge paired successfully.');
    }


    /**
     * @return JsonResponse
     */
    public function checkPaired(): JsonResponse
    {
        $raspbee          = new RaspbeeHelper();
        $raspbeeUser      = $raspbee->getUser();
        $raspbeeConnected = $raspbee->checkConnection();


        $hue          = new HueHelper();
        $hueUser      = $hue->getUser();
        $hueConnected = $hue->checkConnection();

        return Response()->json(
            [
                'raspbeeUser'      => $raspbeeUser,
                'raspbeeConnected' => $raspbeeConnected,
                'hueUser'          => $hueUser,
                'hueConnected'     => $hueConnected,
            ]
        );
    }
}