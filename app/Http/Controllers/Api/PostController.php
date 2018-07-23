<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Helpers\Facades\Helper;
use App\Helpers\Facades\Uploader;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Return a paginated list of posts by category or all.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if ($request->has('category')) {
            $categoryId = $request->get('category');
            $category = Category::find($categoryId);
            if(!is_null($category)) {
                $posts = $category->posts()->paginate(9);
            } else {
                $posts = null;
            }
        } else {
            $posts = Post::latest()
                ->paginate(20);
        }

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
        $newData = $request->only('name', 'content');
        if($request->has('file')) {
            $fileName = Uploader::uploadFile($request->file('file'));
            $newData['file_type'] = Uploader::getFileType($fileName);
            $newData['file'] = $fileName;
        }
        $post = Post::create($newData);
        $categoriesList = Helper::toCategories($request->get('categories'));
        if(!empty($categoriesList)) {
            $post->categories()->saveMany($categoriesList);
        }

        return response(new PostResource($post), Response::HTTP_CREATED);
    }

    /**
     * Validate and update a post to the database.
     * @param PostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostRequest $request, Post $post)
    {
        $arrayForUpdate = $request->all();
        if($request->has('file')) {
            $fileName = Uploader::uploadFile($request->file('file'));
            $fileType = Uploader::getFileType($fileName);
            $arrayForUpdate['file'] = $fileName;
            $arrayForUpdate['fileType'] = $fileType;
        }
        $post->update($arrayForUpdate);

        if($request->has('categories')) {
            $categoriesList = Helper::toCategories($request->get('categories'), true);
            if (!empty($categoriesList)) {
                $post->categories()->sync($categoriesList);
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
