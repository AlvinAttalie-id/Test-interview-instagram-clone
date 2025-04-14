<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\MediaPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, MediaPost $mediaPost)
    {

        $request->validate([
            'comment' => 'required|string|max:500',
        ]);


        $comment = $mediaPost->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);


        return response()->json([
            'comment' => $comment->load('user'),
        ]);
    }
}
