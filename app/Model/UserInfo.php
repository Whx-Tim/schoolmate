<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $guarded = ['_token','_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
