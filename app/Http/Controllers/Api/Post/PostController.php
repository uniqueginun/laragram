<?php

namespace App\Http\Controllers\Api\Post;

use App\Events\Post\PostCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostResource;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function show(Post $post)
    {
        $post->load(['images', 'user']);

        return new PostResource($post);
    }

    public function store(PostStoreRequest $request)
    {

        DB::beginTransaction();

        try {

            $post = $request->user()->posts()->create($request->only(['caption']));

            collect($request->media)->map(function ($file, $index) use ($post) {
                return $post->images()->create($this->uploadFile($file));
            });

            DB::commit();

            $post->load('images');

            broadcast(new PostCreated($post));

            return response()->json([
                'post' => new PostResource($post)
            ], 201);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'error' => $exception->getMessage()
            ], 500);
        }


    }

    protected function uploadFile($file)
    {
        $upload = $file->store('uploads', 'public');
        Image::make(public_path('storage/' . $upload))->fit(1200, 1200)->save();
        return ['path' => $upload];
    }
}
