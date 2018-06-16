<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->simplePaginate(5);

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

        $body = request('body');

        $dom = new \domdocument();
        $dom->loadHTML($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(,$data) = explode(',', $data);

            $data = base64_decode($data);
            $image_name = time().$k.'.png';
            $path = public_path().'/images/'.$image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', asset('images/'.$image_name));
        }

        $body = $dom->savehtml();
        $data = array();
        $data['title'] = request('title');
        $data['body'] = $body;
        auth()->user()->publish(
            new Post($data)
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

        return redirect('/posts/'.$id);
    }

    public function destroy(Post $post) {
        $dom = new \domdocument();
        $dom->loadHTML($post->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $k => $img){
            $image_name = basename($img->getattribute('src'));

            if(file_exists(public_path().'/images/'.$image_name)) {
                File::delete(public_path().'/images/'.$image_name);
            }
        }

        $post->delete();

        return redirect('/users/'.$post->user->id);
    }

    public function userPosts(User $user) {
        $posts = $user->posts;

        return view('posts.user', compact('posts', 'archives', 'user'));
    }
}
