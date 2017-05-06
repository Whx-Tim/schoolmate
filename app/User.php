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
        'name', 'email', 'password','username'
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

    /**
     * 系统管理员发布公告信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function announcements()
    {
        return $this->morphMany('App\Model\Announcement', 'announcement');
    }

    public function editUrl()
    {
        return url('admin/user/edit/'.$this->id);
    }

    public function deleteUrl()
    {
        return url('admin/user/delete/'. $this->id);
    }

    public function detailUrl()
    {
        return url('admin/user/detail/'. $this->id);
    }

    public function activeToString()
    {
        switch ($this->is_active) {
            case 0:
                return '未激活';
            case 1:
                return '已激活';
            default:
                return '未知状态';
        }
    }


}
