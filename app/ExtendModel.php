<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtendModel extends Model
{
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
}
