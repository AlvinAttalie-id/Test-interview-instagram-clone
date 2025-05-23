<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Foto Profil dan Info --}}
        <div class="flex flex-col md:flex-row md:items-start md:space-x-10">
            <div class="w-20 h-20 overflow-hidden border border-gray-300 rounded-full shadow md:w-24 md:h-24">
                <img src="{{ $user->profileSetting?->profile_picture
                    ? asset('storage/' . $user->profileSetting->profile_picture)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&bold=true' }}"
                    alt="{{ $user->username }}" class="object-cover w-full h-full">
            </div>


            <div class="flex-1 mt-4 md:mt-0">
                <div class="flex flex-col mb-4 md:flex-row md:items-center md:space-x-6">
                    <h1 class="text-2xl font-semibold">{{ $user->username }}</h1>

                    @auth
                        @if (Auth::id() !== $user->id)
                            @if ($isFollowed)
                                <form method="POST" action="{{ route('unfollow', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-1 mt-2 text-sm text-gray-700 border rounded hover:bg-gray-100 md:mt-0">
                                        Unfollow
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('follow', $user->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-1 mt-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600 md:mt-0">
                                        Follow
                                    </button>
                                </form>
                            @endif
                        @endif
                    @endauth
                </div>

                <div class="flex mb-4 space-x-6 text-sm text-gray-700">
                    <div><span class="font-semibold">{{ $user->mediaPosts->count() }}</span> posts</div>
                    <div>
                        <a href="{{ route('user.followers', $user->id) }}" class="hover:underline">
                            <span class="font-semibold">{{ $user->followers()->count() }}</span> followers
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user.following', $user->id) }}" class="hover:underline">
                            <span class="font-semibold">{{ $user->following()->count() }}</span> following
                        </a>
                    </div>
                </div>

                <div class="space-y-1 text-sm text-gray-800">


                    @if ($user->profileSetting?->bio)
                        <div>{{ $user->profileSetting->bio }}</div>
                    @endif

                    @if ($user->website)
                        <div>
                            <a href="{{ $user->website }}" target="_blank" class="text-blue-500 hover:underline">
                                {{ $user->website }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Grid Postingan --}}
        <div class="mt-10 ig-grid">
            @forelse ($posts as $post)
                <a href="{{ route('profile.posts.show', $post) }}" class="ig-grid-item">
                    @if ($post->file_type === 'image')
                        <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post image">
                    @elseif ($post->file_type === 'video')
                        <video muted>
                            <source src="{{ asset('storage/' . $post->file_path) }}">
                        </video>
                    @endif
                </a>
            @empty
                <div class="text-center text-gray-500 col-span-full">Belum ada postingan.</div>
            @endforelse
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/ig-grid.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/ig-grid.js') }}" defer></script>
    @endpush
</x-app-layout>
