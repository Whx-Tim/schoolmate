<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $guarded = ['_token','_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'active_applies')->withTimestamps();
    }

}
