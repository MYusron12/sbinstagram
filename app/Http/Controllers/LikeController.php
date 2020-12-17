<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($post_id)
    {
        $post = Post::findOrFail($post_id);
        $attr = ['user_id' => Auth::user()->id];

        if ($post->likes()->where($attr)->exists()) {
            $post->likes()->where($attr)->delete();
            $msg = ['status' => 'UNLIKE'];
        } else {
            $post->likes()->create($attr);
            $msg = ['status' => 'LIKE'];
        }
        return response()->json($msg);
    }
}
