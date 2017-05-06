<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = ['_token', '_method'];

    protected $condition_array = ['created_at', 'updated_at'];

    protected $dates = [];

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

    public function homeUrl()
    {
        return url('admin/announcement');
    }

    public function editUrl()
    {
        return url('admin/announcement/edit/'. $this->id);
    }

    public function deleteUrl()
    {
        return url('admin/announcement/delete/'. $this->id);
    }

    public function detailUrl()
    {
        return url('admin/announcement/detail/'. $this->id);
    }

    public function typeToString()
    {
        foreach (explode('\\',$this->announcement_type) as $item) {
            $type = $item;
        }
        switch ($type) {
            case 'User':
                return "系统公告";
            case 'Course':
                return '课程公告';
            case 'Active':
                return '活动公告';
            case 'League':
                return '社团公告';
        }
    }
}
