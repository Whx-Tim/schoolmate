<?php

namespace App\Model;

use App\ExtendModel as Model;
use App\User;

class Partime extends Model
{
    protected $guarded = ['_token', '_method'];

    protected $condition_array = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function view()
    {
        return $this->morphOne('App\Model\View', 'View');
    }
}
