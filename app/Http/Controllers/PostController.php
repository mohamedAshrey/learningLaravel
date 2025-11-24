<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;



use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(10);
        

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show($post)
    {
        $post = Post::findOrFail($post);
        //$post = Post::where('id', $post)->first();
        //$post = Post::where('title', 'php')->get();
            return view('posts.show', [
                'post' => $post
            ]);
    }

    public function create()
    {
        return view('posts.create', [
            'users' => User::all()
        ]);
    }

    public function store(StorePostRequest $myRequestObject)
    {
        $data = $myRequestObject->all();
        Post::create($data);
        
        return redirect()->route('posts.index');
    }

    public function edit($post)
    {
        $post = Post::findOrFail($post);
        //$post = Post::where('id', $post)->first();
        return view('posts.edit', [
            'post' => $post, 
            'users' => User::all()
        ]);
    }

    public function update(StorePostRequest $myRequestObject, $post)
    {
        $post = Post::findOrFail($post);
        $data = $myRequestObject->all();
        $post->update($data);

        return redirect()->route('posts.index');
    }

    public function destroy($post, Request $myRequestObject)
    {
        $post = Post::findOrFail($post);
        $post->delete();

        $page = $myRequestObject->input('page');
        return redirect()->route('posts.index', ['page' => $page]);
    }

    public function trashes()
    {
        $posts = Post::onlyTrashed()->paginate(10);

        return view('posts.trashes', [
            'posts' => $posts
        ]);
    }

    public function restore($post)
    {
        $post = Post::onlyTrashed()->findOrFail($post);
        $post->restore();
        return redirect()->route('trashes.index');
    }

    public function forceDelete($post)
    {
        $post = Post::onlyTrashed()->findOrFail($post);
        $post->forceDelete();
        return redirect()->route('trashes.index');
    }

}
