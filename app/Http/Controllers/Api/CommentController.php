<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Validate and save a new comment to the database.
     * @param CommentRequest $request
     * @return CommentResource
     */
    public function store(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->author = $request->get('author');
        $comment->content = $request->get('content');
        $comment->post_id = $request->get('post_id');
        $comment->save();
        return response(new CommentResource($comment), Response::HTTP_CREATED);
    }

    /**
     * Destroy comment from database
     * @param Comment $comment
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response(['error' => $e], Response::HTTP_BAD_REQUEST);
        }
    }
}
