<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $guarded = [];

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function sub_replies()
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
