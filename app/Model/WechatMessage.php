<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatMessage extends Model
{
    public static function messageHandle($message)
    {
        return call_user_func([new self(), $message->MsgType], $message);
    }

    public function text($message)
    {
        return 'successful!';
    }

    public function event($message)
    {
        return WechatEvent::eventHandle($message);
    }

}
