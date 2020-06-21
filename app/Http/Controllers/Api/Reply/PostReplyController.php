<?php

namespace App\Http\Controllers\Api\Reply;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostReplyController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $post->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        return new PostResource($post->fresh([
                           'images', 'user', 'likes', 'replies.sub_replies', 'replies.user'
                        ])
                    );
    }
}
