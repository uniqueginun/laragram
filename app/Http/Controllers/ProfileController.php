<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {

        $user->load(['profile']);

        $userData = new UserResource($user);

        $followedByMe = $user->profile->followers()->where('user_id', auth()->id())->exists();

        return view('profile.show', compact('userData', 'followedByMe'));
    }

    public function edit(Request $request)
    {
        return view('profile.edit');
    }
}
