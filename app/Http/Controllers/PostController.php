<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request){
        $this->validate($request, [
            'body'=> 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request->body;
        $message = "Something wrong happend";
        if($request->user()->posts()->save($post)){
            $message = "Post created successfully";
        }
        return redirect('/dashboard')->with(['message'=> $message]);
    }

    public function deletePost($id){
        Post::whereId($id)->delete();
        return redirect('/dashboard');
    }

    public function editPost(Request $request){
        $post = Post::find($request->postId);
        $post->body = $request->body;
        $post->update();
        return response()->json(['new-body' => $post->body], 200);
    }

    public function likePost(Request $request){
        $postId = $request->postId;
        $isLike = $request->isLike == 'true';
        $update = false;
        $post = Post::find($postId);
        if(!$post){
            return response()->json(['msg' => "yesss"], 200);
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $postId)->first();
        if($like){
            $alreadyLike = $like->like;
            $update = true;
            if($alreadyLike == $isLike){
                $like->delete();
                return response()->json(['msg' => "yes"], 200);
            }
        }else{
            $like = new Like();
        }
        $like->user_id = $user->id;
        $like->post_id = $postId;
        $like->like = $isLike;
        if($update){
            $like->update();
        }else{
            $like->save();
        }
        return response()->json(['msg' => "yes"], 200);
    }
}
