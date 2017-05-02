<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    protected $guarded  = ['_token', '_method'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
