<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;

class CommentsController extends Controller
{

    public function index(Post $post){
        return $post->comments->toJson();
    }

    public function store(Post $post){
        $this->validate(request(), ['body' => 'required|min:2']);
        $post->addComment(request('body'));

        return back();
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return back();
    }
}
