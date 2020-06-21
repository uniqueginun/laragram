<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api', 'middleware' => 'auth:sanctum'], function () {
    Route::get('posts/{post}', 'Post\PostController@show');
    Route::get('user/{user}/posts', 'User\UserController@getPosts');
    Route::post('posts', 'Post\PostController@store');
    Route::get('users/{user}', 'User\UserController@show');
    Route::post('profile/{profile}/follow', 'Profile\ProfileController@following');
    Route::post('profile/update', 'Profile\ProfileController@update');
    Route::get('timeline', 'Timeline\TimelineController@index');
    Route::post('/likes/{post}/like', 'Like\PostLikeController@toggleLike');
    Route::post('/comments/{post}/add', 'Reply\PostReplyController@store');
    Route::get('/suggestions', 'Timeline\SuggestionsController@index');
});


