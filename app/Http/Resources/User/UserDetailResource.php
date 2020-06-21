<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Profile\ProfileResource;

class UserDetailResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'followers' => UserResource::collection($this->profile->followers),
            'following' => ProfileResource::collection($this->following),
        ]);
    }
}
