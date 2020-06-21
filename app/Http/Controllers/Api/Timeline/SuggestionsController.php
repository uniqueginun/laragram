<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\User;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function index(Request $request)
    {
        $following = $request->user()->following->pluck('user_id')->toArray();

        $suggestions = User::whereNotIn('id', array_merge($following, [auth()->id()]))
            ->with(['profile'])
            ->latest()
            ->take(7)
            ->get();

        return new UserCollection($suggestions);
    }
}
