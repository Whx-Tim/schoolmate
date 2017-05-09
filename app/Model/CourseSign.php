<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CourseSign extends Model
{
    protected $guarded = ['_token', '_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
