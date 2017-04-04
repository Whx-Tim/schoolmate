<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

class Active extends Model
{
    protected $guarded = ['_token','_method'];

    protected $condition_array = ['created_at','update_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'active_applies')->withTimestamps();
    }

}
