<?php

namespace App\Listeners;

use App\Events\UserGetMessageList;
use App\Model\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class readAllMessage
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
     * @param  UserGetMessageList  $event
     * @return void
     */
    public function handle(UserGetMessageList $event)
    {
        $send_to = $event->send_to;
        $send_from = Auth::id();
        Message::where([
            ['send_to', $send_from],
            ['send_from', $send_to]
        ])->update(['readed' => 1]);
    }
}
