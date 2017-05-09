<?php

namespace App\Listeners;

use App\Events\Created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PushMessageToAdmin
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
     * @param  Created  $event
     * @return void
     */
    public function handle(Created $event)
    {
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new \Pusher(
            '5a573c7b51d3fbfc6713',
            '3958d7b81c95d79ba89d',
            '336180',
            $options
        );

        $pusher->trigger('admin-channel', 'message-event', ['message' => $event->message]);
    }
}
