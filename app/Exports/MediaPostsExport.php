<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MediaPostsExport implements FromView
{
    protected $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    public function view(): View
    {
        return view('media-posts.exports.excel', [
            'posts' => $this->posts
        ]);
    }
}
