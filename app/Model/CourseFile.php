<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseFile extends Model
{
    protected $fillable = ['path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
