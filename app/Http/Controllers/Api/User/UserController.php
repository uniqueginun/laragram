<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\User\UserDetailResource;
use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getPosts(User $user)
    {
        $posts = $user->posts()->latest()->paginate(6);

        return new PostCollection($posts);
    }

    public function show(User $user, Request $request)
    {
        if ($request->has('plain')) {
            return new UserResource($user->load(['profile']));
        }

        $user->load(['following.user', 'profile.followers']);

        return new UserDetailResource($user);
    }
}
