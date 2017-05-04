<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtendModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['_token', '_method'];

    protected $condition_array = [];

    protected $condition_default = 'created_at';

    public function getListOrderByDesc($condition = 'created_at', $perPage = 10)
    {
        if (!in_array($condition, $this->condition_array)) {
            $condition = $this->condition_default;
        }

        return static::orderBy($condition, 'desc')->paginate($perPage);
    }

    public function statusToString()
    {
        switch ($this->status) {
            case 0:
                return '未审核';
            case 1:
                return '已审核';
            case 2:
                return '已关闭';
        }
    }

    public function viewIncrement()
    {
        if ($this->view) {
            $this->view()->increment('count');
        } else {
            $this->view()->create(['count' => 0]);
        }
    }
}
