<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;
use App\Models\ProfileSetting;

class ProfilePageController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        $posts = MediaPost::where('user_id', $user->id)->latest()->get();
        $feedPerRow = $user->feed_per_row ?? 3; // Default 3 per row jika tidak ada pengaturan

        return view('profile.index', compact('user', 'posts', 'feedPerRow'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,mp4,mov|max:153600',
            'caption' => 'nullable|string|max:500',
        ]);

        $file = $request->file('file');
        $path = $file->store('media_posts', 'public');

        MediaPost::create([
            'user_id' => auth()->id(),
            'file_path' => $path,
            'type' => in_array($file->getClientOriginalExtension(), ['mp4', 'mov']) ? 'video' : 'image',
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Post berhasil diunggah!');
    }
}
