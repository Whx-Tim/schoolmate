<?php

namespace App\Http\Controllers;

use App\Models\WechatMessage;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    private $wechat;

    public function __construct()
    {
        $this->wechat = app('wechat');
    }

    public function server()
    {
//        $app = new Application(config('wechat'));
        $server = $this->wechat->server;
        $server->setMessageHandler(function ($message) {
            return WechatMessage::messageHandle($message);
        });

        $response = $server->serve();

        return $response;
    }
}
