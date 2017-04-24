<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * 获取评论的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }
}
