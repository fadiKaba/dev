<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;

class CommentsController extends Controller
{   
    public function index(){

        $comments = Comment::all();
        return $comments;
    }
    public function store(Request $request, $postId){
       
       $request->validate([
           'body' => 'required|max:200'
       ]);

       $post = Post::findOrFail($postId);
       $comment = Comment::create([
           'user_id' => Auth::id(),
           'post_id' => $post->id,
           'body' => $request->body,
       ]);

       return $comment;
    }

    public function destroy($commentId){
        $comment = Comment::findOrFail($commentId);
        if($comment->user_id == Auth::id()){
            $comment->delete();
            return $comment;
        }else{
            return 'NotAutorized';
        }
        
    }
}
