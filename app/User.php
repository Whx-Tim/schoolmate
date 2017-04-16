<?php

namespace App;

use App\Model\Active;
use App\Model\Course;
use App\Model\Good;
use App\Model\League;
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

    public function applyLeagues()
    {
        return $this->belongsToMany(League::class, 'league_groups')->withTimestamps();
    }

    public function leagues()
    {
        return $this->hasMany(League::class);
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

    /**
     * 获取用户参与活动的公告信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function activeAnnouncements()
    {
        return $this->hasManyThrough('App\Model\Active', 'App\Model\Announcement');
    }

    /**
     * 获取用户参与课程的公告信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function courseAnnouncements()
    {
        return $this->hasManyThrough('App\Model\Course', 'App\Model\Announcement');
    }

    /**
     * 获取用户参与社团的公告信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function leagueAnnouncements()
    {
        return $this->hasManyThrough('App\Model\League', 'App\Model\Announcement');
    }

    public function goods()
    {
        return $this->hasMany(Good::class);
    }

}
