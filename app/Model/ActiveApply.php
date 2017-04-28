<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ActiveApply extends Model
{
    protected $guarded = ['_token', '_method'];
}
