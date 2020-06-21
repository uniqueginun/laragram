<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function following(Profile $profile, Request $request)
    {
        $request->user()->following()->toggle($profile);

        return $profile->followers;
    }

    public function update(Request $request)
    {

        try {

            $request->user()->update($request->only(['name', 'username', 'email']));

            $profileUdateArr = $request->only(['avatar', 'url', 'bio']);

            if ($request->hasFile('avatar')) {
                $upload = $request->avatar->store('avatars', 'public');
                Image::make(public_path('storage/' . $upload))->fit(400, 400)->save();
                $profileUdateArr = array_merge($profileUdateArr, [
                    'avatar' => $upload
                ]);
            }

            $request->user()->profile()->update($profileUdateArr);

            $message = "your profile updated successfully!";

        } catch (\Exception $exception) {

            $message = "profile updation failed";

        }

        return response()->json($message, 201);
    }
}
