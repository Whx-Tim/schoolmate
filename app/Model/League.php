<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

class League extends Model
{
    protected $guarded = ['_method', '_token', 'id'];

    protected $condition_array = ['created_at', 'updated_at', 'amount'];

    /**
     * 获取创建社团的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取参与社团的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'league_groups')->withTimestamps();
    }

    /**
     * 获取社团的公告
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function announcements()
    {
        return $this->morphMany('App\Model\Announcement', 'announcement');
    }

    /**
     * 获取社团的访问量
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }

    /**
     * 获取社团的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }

    public function editUrl()
    {
        return url('admin/league/edit/'. $this->id);
    }

    public function detailUrl()
    {
        return url('admin/league/detail/'. $this->id);
    }

    public function homeUrl()
    {
        return url('admin/league');
    }

    public function deleteUrl()
    {
        return url('admin/league/delete/'. $this->id);
    }

    public function userName()
    {
        $user = User::select('username')->find($this->user_id);

        return $user->username;
    }

}
