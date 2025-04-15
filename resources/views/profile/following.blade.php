<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Following by {{ $user->username }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-6 mx-auto space-y-4">
        <div class="mb-4">
            <a href="{{ route('profile.page') }}" class="text-blue-600 hover:underline">&larr; Kembali ke profil</a>
        </div>

        @forelse ($following as $followedUser)
            <div class="flex items-center justify-between p-4 bg-white rounded shadow">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.profile', $followedUser->username) }}">
                        <img src="{{ $followedUser->profileSetting?->profile_picture
                            ? asset('storage/' . $followedUser->profileSetting->profile_picture)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($followedUser->name) }}"
                            class="w-12 h-12 rounded-full" alt="{{ $followedUser->name }}">
                    </a>

                    <div>
                        <a href="{{ route('user.profile', $followedUser->username) }}">
                            <p class="font-semibold hover:underline">{{ $followedUser->username }}</p>
                        </a>
                        <p class="text-sm text-gray-500">{{ $followedUser->email }}</p>
                    </div>
                </div>

                {{-- Tombol Follow/Unfollow --}}
                @auth
                    @if (auth()->id() !== $followedUser->id)
                        @if (auth()->user()->isFollowing($followedUser))
                            <form action="{{ route('unfollow', $followedUser->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="px-4 py-1 text-sm text-gray-700 border rounded hover:bg-gray-100">
                                    Unfollow
                                </button>
                            </form>
                        @else
                            <form action="{{ route('follow', $followedUser->id) }}" method="POST">
                                @csrf
                                <button class="px-4 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">
                                    Follow
                                </button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        @empty
            <div class="text-center text-gray-500">Belum mengikuti siapa pun.</div>
        @endforelse
    </div>
</x-app-layout>
