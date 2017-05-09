<?php

namespace App\Listeners;

use App\Events\ApplyOperation;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWechatNotice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApplyOperation  $event
     * @return void
     */
    public function handle(ApplyOperation $event)
    {
        $wechat = app('wechat');
        $data = [
            'username' => $event->username,
            'date'     => Carbon::now()->toDateTimeString(),
            'message'  => $event->content,
        ];
        $wechat->notice->uses('5XOC-gRI9PBr5yWlMlfebp0YWpmVoltqFWx8YwXi67M')->andData($data)->andReceiver('oQAYlwP5ln121gNZz7j6uXn0dTbw')->send();
    }
}
