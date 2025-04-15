<?php

namespace App\Http\Controllers;

use App\Models\MediaPost;
use Illuminate\Http\Request;
use App\Exports\MediaPostsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class MediaPostController extends Controller
{
    public function index()
    {
        $posts = MediaPost::latest()->paginate(3);
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
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:153600',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('media-posts', 'public');

        $fileType = $file->getMimeType();
        $fileType = str_contains($fileType, 'video') ? 'video' : 'image';

        MediaPost::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);

        return redirect()->route('media-posts.index')->with('success', 'Post berhasil ditambahkan.');
    }

    public function archive(Request $request)
    {
        $query = MediaPost::where('user_id', Auth::id());

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $posts = $query->latest()->get();

        return view('media-posts.archive', compact('posts'));
    }

    public function downloadArchive(Request $request)
    {
        $format = $request->get('format', 'pdf');

        $query = MediaPost::where('user_id', Auth::id());

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $posts = $query->latest()->get();

        if ($format === 'xlsx') {
            return Excel::download(new MediaPostsExport($posts), 'media_posts.xlsx');
        } else {
            $pdf = Pdf::loadView('media-posts.exports.pdf', compact('posts'));
            return $pdf->download('media_posts.pdf');
        }
    }


    public function loadMorePosts(Request $request)
    {
        $posts = MediaPost::latest()->paginate(3);

        if ($request->ajax()) {
            $html = '';


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
