<?php

namespace App\Http\Controllers\Api\Like;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function toggleLike(Post $post, Request $request)
    {
        if ($request->user()->hasLiked($post->id)) {
            $post->likes()->where('user_id', $request->user()->id)->delete();
            return response()->json([
                'type' => 'unlike'
            ], 201);
        }

        $like = $post->likes()->create(['user_id' => $request->user()->id]);
        return response()->json([
            'type' => 'like',
            'post_id' => $like->post_id
        ], 201);
    }
}
