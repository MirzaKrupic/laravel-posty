<?php

namespace App\Http\Controllers;

use App\Mail\PostLike;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        if($post->likedBy($request->user())){
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        
        Mail::to($post->user)->send(new PostLike(auth()->user(), $post));

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
