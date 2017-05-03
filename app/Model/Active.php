<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active extends Model
{
    protected $guarded = ['_token','_method'];

    protected $condition_array = ['created_at','update_at'];

    /**
     * 获取发布活动的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取参与活动的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'active_applies')->withTimestamps();
    }

    /**
     * 获取活动的公告
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function announcements()
    {
        return $this->morphMany('App\Model\Announcement', 'announcement');
    }

    /**
     * 获取活动的点击量
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }

    /**
     * 获取活动审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }

    /**
     * 获取活动详情链接
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function detailUrl()
    {
        return url('admin/active/detail/'. $this->id);
    }

    /**
     * 获取活动编辑链接
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function editUrl()
    {
        return url('admin/active/edit/'. $this->id);
    }

    /**
     * 获取活动删除链接
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function deleteUrl()
    {
        return url('admin/active/delete/'. $this->id);
    }

    public function homeUrl()
    {
        return url('admin/active');
    }
}
