<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $this->authorize('create', Comment::class);

        $comment = $post->comments()->create([
            'body' => $request->validated()['body'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('status', 'Comment added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $post = $comment->post;
        $comment->delete();

        return back()->with('status', 'Comment deleted successfully!');
    }
}