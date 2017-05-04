<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $guarded = ['_token', '_method'];

    public function checkable()
    {
        return $this->morphTo();
    }
}
