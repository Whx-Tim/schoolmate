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


    /**
     * 获取商品的审核状态
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function check()
    {
        return $this->morphOne('App\Model\Check', 'checkable');
    }

    public function homeUrl()
    {
        return url('admin/good');
    }

    public function detailUrl()
    {
        return url('admin/good/detail/'. $this->id);
    }

    public function editUrl()
    {
        return url('admin/good/edit/'. $this->id);
    }

    public function deleteUrl()
    {
        return url('admin/good/delete/'. $this->id);
    }

    public function typeToString()
    {
        switch ($this->shopType) {
            case 1:
                return '衣服';
            case 2:
                return '商品';
            case 3:
                return '医药';
            case 4:
                return '水果';
            case 5:
                return '零食';
            case 6:
                return '家具';
            case 7:
                return '书籍';
            case 8:
                return '瓷器';
            case 9:
                return '电器';
            default:
                return '其他';
        }
    }
}
