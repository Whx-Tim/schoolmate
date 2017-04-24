<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

class Course extends Model
{
    protected $guarded = ['_token','_method'];

    protected $condition_array = ['created_at', 'updated_at'];

    /**
     * 获取创建课程的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取参与课程的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_groups')->withTimestamps();
    }

    /**
     * 获取课程的公告
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function announcements()
    {
        return $this->morphMany('App\Model\Announcement', 'announcement');
    }

    /**
     * 获取课程的访问量
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }

    /**
     * 获取该课程的文件
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(CourseFile::class);
    }

    /**
     * 获取课程的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }
}
