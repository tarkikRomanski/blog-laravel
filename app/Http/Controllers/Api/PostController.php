<?php

namespace App\Http\Controllers\Api;

use App\Classes\Facades\StringToObject;
use App\Classes\Facades\Upload;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Return a paginated list of posts.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::latest()
            ->paginate(20);
        return PostResource::hide(['comments'])::collection($posts);
    }

    /**
     * Fetch and return the post.
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Validate and save a new post to the database.
     * @param PostRequest $request
     * @return PostResource
     */
    public function store(PostRequest $request)
    {
        $fileUrl = null;
        if($request->has('file')) {
            $fileUrl = Upload::uploadFile($request->file('file'));
        }

        $post = new Post();
        $post->name = $request->get('name');
        $post->content = $request->get('content');
        $post->file = $fileUrl;
        $post->save();

        $categoriesList = StringToObject::toCategories($request->get('categories'));

        if(!empty($categoriesList)) {
            $post->categories()->saveMany($categoriesList);
        }

        return response(new PostResource($post), Response::HTTP_CREATED);
    }

    /**
     * Validate and update a post to the database.
     * @param Request $request
     * @param Post $post
     * @return PostResource
     */
    public function update(Request $request, Post $post)
    {

        $arrayForUpdate = $request->all();
        if($request->has('file')) {
            $fileUrl = Upload::uploadFile($request->file('file'));
            $arrayForUpdate['file'] = $fileUrl;
        }
        $post->update($arrayForUpdate);
        
        if($request->has('categories')) {
            $categoriesList = StringToObject::toCategories($request->get('categories'));
            if (!empty($categoriesList)) {
                $post->categories()->saveMany($categoriesList);
            }
        }

        return response(new PostResource($post), Response::HTTP_CREATED);
    }

    /**
     * Destroy post from database
     * @param Post $post
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response(['error' => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
