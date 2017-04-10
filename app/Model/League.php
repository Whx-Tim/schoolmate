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
}
