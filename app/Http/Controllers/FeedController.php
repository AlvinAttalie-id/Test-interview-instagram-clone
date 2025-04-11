<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        // Ambil semua post terbaru, beserta user & like-nya
        $posts = MediaPost::with(['user', 'likes'])->latest()->get();

        return view('feed.index', compact('posts'));
    }
}
