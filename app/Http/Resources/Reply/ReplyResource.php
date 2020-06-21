<?php

namespace App\Http\Resources\Reply;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'sub_replies' => ReplyResource::collection($this->sub_replies),
            'user' => new UserResource($this->user)
        ];
    }
}
