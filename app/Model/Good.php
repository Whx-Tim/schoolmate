<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

class Good extends Model
{
    protected $guarded = ['_token','_method'];

    protected $condition_array = ['created_at','updated_at','shopNumber','shopPrice'];

    /**
     * 获取商品的商家信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取商品信息的访问量
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function view()
    {
        return $this->morphOne('App\Model\View', 'view');
    }
}
