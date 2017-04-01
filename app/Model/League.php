<?php

namespace App\Model;

use App\User;
use App\ExtendModel as Model;

class League extends Model
{
    protected $guarded = ['_method', '_token', 'id'];

    protected $condition_array = ['created_at', 'updated_at', 'amount'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class, 'league_groups')->withTimestamps();
    }
}
