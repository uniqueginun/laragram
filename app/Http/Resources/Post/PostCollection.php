<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{

    public $collects = PostResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }

    public function with($request)
    {
        return [
          'user_likes' => $this->grabMyLikes($request),
          'user_replies' => $this->grabMyReplies($request),
        ];
    }

    private function grabMyLikes($request)
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->likes()
                    ->whereIn('post_id', $this->collection->pluck('id'))
                    ->pluck('post_id')
                    ->toArray();
    }

    private function grabMyReplies($request)
    {
        if (!$user = $request->user()) {
            return ['nope' => true];
        }

        return $user->replies()
                    ->whereIn('post_id', $this->collection->pluck('id'))
                    ->pluck('post_id')
                    ->toArray();
    }
}
