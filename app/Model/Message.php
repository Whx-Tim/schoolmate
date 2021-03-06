<?php

namespace App\Model;

use App\ExtendModel as Model;
use App\User;

class Message extends Model
{
    protected $guarded = ['_token', '_method'];

    protected $condition_array = ['created_at', 'updated_at'];

    public static function getList($send_from, $send_to)
    {
        return static::where([
            ['send_from', $send_from],
            ['send_to', $send_to]
        ])->orWhere([
            ['send_from', $send_to],
            ['send_to', $send_from]
        ])->orderBy('created_at', 'desc')->paginate();
    }

    public function from_user()
    {
        return $this->belongsTo(User::class, 'send_from');
    }

    public function to_user()
    {
        return $this->belongsTo(User::class, 'send_to');
    }
}
