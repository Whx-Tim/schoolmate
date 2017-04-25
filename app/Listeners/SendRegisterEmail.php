<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail
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
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $code = md5($event->user_id);
        $email = $event->email;
        Cache::put($code, $event->user_id, 30);
        Mail::send('emails.register', compact('code'), function ($message) use ($email) {
            $message->from('whx@lewitech.cn', '校园资源互助平台');
            $message->to($email)->subject('校园资源互助平台————请激活您的账号~~');
        });
    }
}
