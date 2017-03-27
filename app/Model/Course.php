<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = ['_token','_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_groups')->withTimestamps();
    }
}
