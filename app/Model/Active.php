<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

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
}
