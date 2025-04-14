<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\MediaPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'media_post_id' => 'required|exists:media_posts,id',
        ]);

        $mediaPostId = $request->media_post_id;
        $userId = Auth::id();


        $like = Like::where('media_post_id', $mediaPostId)
            ->where('user_id', $userId)
            ->first();


        if ($like) {
            $like->delete();
            $liked = false;
        } else {

            Like::create([
                'media_post_id' => $mediaPostId,
                'user_id' => $userId,
            ]);
            $liked = true;
        }


        $likesCount = Like::where('media_post_id', $mediaPostId)->count();

        return response()->json([
            'likes_count' => $likesCount,
            'liked' => $liked,
        ]);
    }
}
