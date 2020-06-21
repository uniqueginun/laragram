<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Post;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index(Request $request)
    {
        $ids = $request->user()->following->map(function ($profile) {
            return $profile->user_id;
        })->toArray();

        $posts = Post::whereIn('user_id', array_merge($ids, [$request->user()->id]))
                        ->latest()
                        ->with(['images', 'user', 'likes', 'replies.sub_replies', 'replies.user'])
                        ->paginate(6);

        return new PostCollection($posts);
    }
}
