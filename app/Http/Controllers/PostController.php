<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $email = $request->email;
        $user = User::where('email', $email)->first();

        $post = new Post();

        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = "http://lorempixel.com/400/200/sports/";
        $post->likes = 0;
        $post->user_id = $user->id;

        $post->save();
        return response()->json([
            'Status' => 'Post created',
        ]);
    }

    public function deletePost(Request $request){
        $post = Post::find($request->post_id);
        $post->delete();
        return response()->json([
            'Status' => 'Post deleted',
        ]);
    }
}
