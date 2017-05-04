<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $guarded = [];

    public function view()
    {
        return $this->morphTo();
    }
}
