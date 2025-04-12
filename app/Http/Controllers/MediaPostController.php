<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;

class MediaPostController extends Controller
{
    public function index()
    {
        $posts = MediaPost::with(['user', 'likes', 'comments'])->latest()->paginate(12);
        return view('media-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('media-posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240', // max 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('media-posts', 'public');

        $fileType = $file->getMimeType();
        $fileType = str_contains($fileType, 'video') ? 'video' : 'image';

        MediaPost::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);

        return redirect()->route('media-posts.index')->with('success', 'Post berhasil ditambahkan.');
    }
}
