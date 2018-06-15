<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();

        return view('posts.index', compact('posts', 'archives'));
    }

    public function show(Post $post) {
        return view('posts.show', compact('post'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {

        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required'
        ]);

        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        return redirect('/');
    }

    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id) {
        $p = new Post();
        $data = $this->validate($request, [
           'title' => 'required|min:2',
            'body' => 'required|min:5'
        ]);
        $data['id'] = $id;
        $p->updatePost($data);

        return back();
    }

    public function destroy(Post $post) {
        $post->delete();

        return redirect('/users/'.$post->user->id);
    }

    public function userPosts(User $user) {
        $posts = $user->posts;

        return view('posts.user', compact('posts', 'archives', 'user'));
    }
}
