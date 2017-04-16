<?php

namespace App\Model;

use App\ExtendModel as Model;

class Announcement extends Model
{
    protected $condition_array = ['created_at', 'updated_at'];

    public function announcement()
    {
        return $this->morphTo();
    }

    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }
}
