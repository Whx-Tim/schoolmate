<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    public function checkable()
    {
        return $this->morphTo();
    }
}
