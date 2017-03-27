<?php

namespace App;

use App\Model\Active;
use App\Model\Course;
use App\Model\UserInfo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function applyActives()
    {
        return $this->belongsToMany(Active::class, 'active_applies')->withTimestamps();
    }

    public function applyCourses()
    {
        return $this->belongsToMany(Course::class, 'course_groups')->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function actives()
    {
        return $this->hasMany(Active::class);
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }
}
