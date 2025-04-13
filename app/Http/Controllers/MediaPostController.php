<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;

class MediaPostController extends Controller
{
    public function index()
    {
        $posts = MediaPost::latest()->paginate(3); // awal juga harus 3 agar konsisten
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

    // Fungsi untuk memuat lebih banyak post
    public function loadMorePosts(Request $request)
    {
        $posts = MediaPost::latest()->paginate(3); // atau 5, sesuai kebutuhan

        if ($request->ajax()) {
            $html = '';

            // Loop semua post dan render satu per satu menggunakan partial
            foreach ($posts as $post) {
                $html .= view('media-posts.partials.post', compact('post'))->render();
            }

            return response()->json([
                'html' => $html,
                'next_page' => $posts->currentPage() + 1,
                'has_more' => $posts->hasMorePages(),
            ]);
        }

        return view('media-posts.index', compact('posts'));
    }
}
