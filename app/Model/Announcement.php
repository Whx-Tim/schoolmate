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

    /**
     * 获取公告的访问量
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }

    /**
     * 获取公告的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }

    /**
     * 获取公告的评论信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Model\Comment', 'comment');
    }
}
