<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Displays single post page
     * @param $postId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get($postId)
    {
        if(is_null(Post::find($postId))) {
            abort(404);
        }

        return view('posts.get', ['postId' => $postId]);
    }

    /**
     * Displays create post form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Displays update post form
     * @param $postId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($postId)
    {
        return view('posts.update', ['postId' => $postId]);
    }
}
