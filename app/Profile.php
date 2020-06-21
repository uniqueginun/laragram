<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatar()
    {
        if (!$this->avatar) {
            return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->user->email ) ) ) . "?d=mp";
        }

        return "/storage/" . $this->avatar;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
