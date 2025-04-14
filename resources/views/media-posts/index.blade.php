<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Semua Postingan Media
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Post List -->
        <div id="post-container" class="space-y-6">
            @foreach ($posts as $post)
                <div class="post-card">
                    <div class="post-username">
                        {{ $post->user->name ?? 'Unknown User' }}
                        <span class="block text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y \p\u\k\u\l H:i') }}
                        </span>
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
            @endforeach
        </div>


        <!-- Menampilkan pagination -->
        {{-- {{ $posts->links() }} --}}

        {{-- Loading Indicator --}}
        <div id="loading-indicator" class="hidden mt-4 text-center">
            <span>Loading...</span>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/post-card.css') }}">
    @endpush

    @push('scripts')
        <script>
            const loadMoreUrl = "{{ route('media-posts.load') }}";
        </script>
        <script src="{{ asset('js/scroll.js') }}" defer></script>
    @endpush

</x-app-layout>
