<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MediaPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, MediaPost $mediaPost)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'media_post_id' => $mediaPost->id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar ditambahkan!');
    }
}
