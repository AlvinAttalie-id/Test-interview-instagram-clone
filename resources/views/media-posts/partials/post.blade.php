<div class="post-card">
    <div class="post-username">
        {{ $post->user->name ?? 'Unknown User' }}
    </div>
    <div class="post-media-wrapper">
        @if ($post->file_type === 'image')
            <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post Image">
        @elseif ($post->file_type === 'video')
            <video controls>
                <source src="{{ asset('storage/' . $post->file_path) }}" />
            </video>
        @endif
    </div>
    <div class="post-info">
        @if ($post->caption)
            <p>{{ $post->caption }}</p>
        @endif
        <small>{{ $post->likes->count() }} Likes • {{ $post->comments->count() }} Comments</small>
    </div>
</div>
