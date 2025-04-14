<div class="p-4 mb-4 bg-white rounded-lg shadow-md post-card">
    {{-- Username dan Dropdown --}}
    <div class="flex items-center justify-between mb-2">
        <span class="font-semibold">{{ $post->user->name }}</span>
        <div class="relative">
            <button class="text-gray-500 hover:text-black focus:outline-none">⋯</button>
            <div class="absolute right-0 z-10 hidden mt-2 bg-white border rounded shadow dropdown-menu">
                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Edit</a>
                <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Delete</a>
            </div>
        </div>
    </div>

    {{-- Media --}}
    <div class="mb-2">
        @if ($post->file_type === 'image')
            <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post Image" class="w-full rounded-md">
        @elseif ($post->file_type === 'video')
            <video controls class="w-full rounded-md">
                <source src="{{ asset('storage/' . $post->file_path) }}">
            </video>
        @endif
    </div>

    {{-- Caption --}}
    @if ($post->caption)
        <p class="mb-2 text-sm text-gray-700">{{ $post->caption }}</p>
    @endif

    {{-- Action buttons like & comment --}}
    <div class="flex items-center justify-start gap-6 pt-2 mb-2 text-gray-600 border-t">
        @php
            $isLiked = $post->likes->contains('user_id', auth()->id());
        @endphp

        {{-- Like Button --}}
        <button
            class="flex items-center gap-1 like-button {{ $isLiked ? 'text-pink-500' : 'text-gray-500' }} hover:text-pink-500"
            data-id="{{ $post->id }}">
            <!-- Love icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 21l-1-1c-5-5-7-7.5-7-10A4 4 0 0112 3a4 4 0 017 4c0 2.5-2 5-7 10l-1 1z" />
            </svg>
            <span class="like-count like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
        </button>

        {{-- Comment Toggle --}}
        <button class="flex items-center gap-1 text-gray-500 hover:text-blue-500 comment-toggle"
            data-id="{{ $post->id }}">
            💬 <span class="comment-count comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span>
        </button>
    </div>

    {{-- Comment Section --}}
    <div class="hidden comment-section" id="comments-{{ $post->id }}">
        <form class="flex gap-2 mb-2 comment-form" data-id="{{ $post->id }}">
            <input type="text" name="comment" placeholder="Tulis komentar..." required
                class="flex-1 px-3 py-1 text-sm border rounded">
            <button type="submit" class="px-3 py-1 text-sm text-white bg-blue-500 rounded">Kirim</button>
        </form>

        <ul class="text-sm space-y-1 comments-list-{{ $post->id }}">
            @foreach ($post->comments as $comment)
                <li>
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                    <small class="text-gray-400">({{ $comment->created_at->diffForHumans() }})</small>
                </li>
            @endforeach
        </ul>
    </div>
</div>
