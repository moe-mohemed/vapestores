<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use App\Store;
use App\Http\Requests;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    //
    public function store(CommentRequest $request)
    {
        //$store = new Store;
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->store_id = $request->store_id;
        $comment->save();
        flash()->success('success', 'Thanks for your comment');
        return redirect()->back();
    }
}
