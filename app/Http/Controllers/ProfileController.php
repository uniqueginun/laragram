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

        return view('profile.show', compact('userData'));
    }
}
