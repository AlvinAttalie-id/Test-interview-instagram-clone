<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Feed') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto space-y-8">

            @foreach ($posts as $post)
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    {{-- Header: User Info --}}
                    <div class="flex items-center px-4 py-3 space-x-4">
                        <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" alt="avatar"
                            class="object-cover w-10 h-10 rounded-full">
                        <div>
                            <div class="font-semibold">{{ $post->user->username }}</div>
                            <div class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    {{-- Media (Image or Video) --}}
                    <div>
                        @if (Str::endsWith($post->media_path, ['.jpg', '.jpeg', '.png']))
                            <img src="{{ asset('storage/' . $post->media_path) }}" alt="media"
                                class="w-full max-h-[500px] object-cover">
                        @elseif(Str::endsWith($post->media_path, ['.mp4', '.mov']))
                            <video controls class="w-full max-h-[500px]">
                                <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>

                    {{-- Caption --}}
                    <div class="px-4 py-3">
                        <p class="text-sm"><strong>{{ $post->user->username }}:</strong> {{ $post->caption }}</p>
                    </div>

                    {{-- Like Section --}}
                    <div class="flex items-center justify-between px-4 pb-3 text-sm text-gray-600">
                        <form action="{{ route('likes.toggle', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit">
                                ❤️ {{ $post->likes->count() }} Likes
                            </button>
                        </form>
                        <a href="{{ route('media.show', $post->id) }}" class="text-blue-500 hover:underline">View
                            Details</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
