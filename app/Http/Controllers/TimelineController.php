<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserCollection;
use App\User;
use Illuminate\Http\Request;

class TimelineController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('welcome');
    }
}
