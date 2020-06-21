<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Reply\ReplyResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'images' => ImageResource::collection($this->images),
            'user' => new UserResource($this->user),
            'likes' => $this->likes()->count(),
            'replies' => ReplyResource::collection(
                $this->replies()->parents()->with('sub_replies', 'user')->latest()->get()
            ),
            'created_at' => $this->created_at->timestamp
        ];
    }
}
