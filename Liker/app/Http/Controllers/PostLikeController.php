<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Transformers\PostTransformer;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Request $request)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return fractal()
               ->item($post->fresh())
               ->transformWith(new PostTransformer())
               ->toArray();
    }
}
