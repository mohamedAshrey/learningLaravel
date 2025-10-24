<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{

    public function index($post)
    {
        $post = Post::findOrFail($post);
        $comments = $post->comments()->orderBy('created_at', 'asc')->paginate(10);

        return view('comments.index', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function create($post)
    {
        $post = Post::findOrFail($post);

        return view('comments.create',[
            'users' => User::all(),
            'post'=> $post
        ]);
    }

    public function store($post, Request $myRequestObj)
    {
        $post = Post::findOrFail($post);
        $post->comments()->create( $myRequestObj->all() );
        
        
        return redirect()->route('comments.index', [
            'post' => $post
        ]);
    }
    
    public function edit($comment)
    {
        $comment = Comment::findOrFail($comment);
        return view('comments.edit', [
            'comment' => $comment,
            'users' => User::all()
        ]);
    }

    public function update($comment, Request $myRequestObj)
    {
        $comment = Comment::findOrFail($comment);
        $comment->update($myRequestObj->all());

        return redirect()->route('comments.index',[
            'post'=>$comment->commentable_id
        ]);
    }

    public function destroy($comment)
    {
        $comment = Comment::findOrFail($comment);
        $post = $comment->commentable_id ; 
        $comment->delete();

        return redirect()->route('comments.index',['post'=>$post]);
    }
    
}
