<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;

class ProfilePageController extends Controller
{
    // This method shows the user's profile page with their posts
    public function index()
    {
        $user = auth()->user();
        $posts = MediaPost::where('user_id', $user->id)->latest()->get();
        $feedPerRow = $user->feed_per_row ?? 3;

        return view('profile.index', compact('user', 'posts', 'feedPerRow'));
    }


    public function show(MediaPost $post)
    {

        if ($post->user_id !== auth()->id()) {
            abort(403);
        }


        return view('profile.post-show', [
            'post' => $post,
            'user' => auth()->user(),
        ]);
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
            'file_type' => in_array($file->getClientOriginalExtension(), ['mp4', 'mov']) ? 'video' : 'image',
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Post successfully uploaded!');
    }


    public function delete(MediaPost $post)
    {

        if ($post->user_id !== auth()->id()) {
            abort(403); // Jika bukan milik user, tampilkan 403
        }

        $post->delete();

        return redirect()->route('profile.page')->with('success', 'Post telah dihapus.');
    }

    public function archive()
    {
        $user = auth()->user();

        $archivedPosts = MediaPost::onlyTrashed()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile.archive', compact('user', 'archivedPosts'));
    }

    public function restore($id)
    {
        $post = MediaPost::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('profile.archive')->with('success', 'Post berhasil dipulihkan.');
    }

    public function deletePermanent(MediaPost $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->forceDelete();

        return redirect()->route('profile.archive')->with('success', 'Post telah dihapus secara permanen.');
    }
}
