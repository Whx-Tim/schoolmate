<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $guarded = ['_method', '_token', 'id'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function users()
    {
        $this->belongsToMany(User::class, 'league_groups')->withTimestamps();
    }
}
