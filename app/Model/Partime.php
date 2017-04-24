<?php

namespace App\Model;

use App\ExtendModel as Model;
use App\User;

class Partime extends Model
{
    protected $guarded = ['_token', '_method'];

    protected $condition_array = ['created_at', 'updated_at'];

    /**
     * 获取审核的用户信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取兼职信息的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'View');
    }

    /**
     * 获取兼职信息的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }

}
