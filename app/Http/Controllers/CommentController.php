<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        // dd($request);
        $request->validate([
            'body' => 'required'
        ]);

        $user = Auth::user();

        $user->comments()->create([
            'body' => $request->body,
            'post_id' => $post_id
        ]);
        return redirect('/post/' . $post_id);
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('post.comment-edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $comment = Comment::find($id);

        if ($comment->user_id !=  Auth::user()->id)
            abort(403);

        $comment->update([
            'body' => $request->body
        ]);

        return redirect('/post/' . $comment->post_id);
    }
}
