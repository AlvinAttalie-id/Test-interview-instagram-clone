<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{-- Flex baris antara foto dan informasi --}}
        <div class="flex flex-col md:flex-row md:items-start md:space-x-10">
            {{-- Foto Profil (UKURAN TIDAK DIUBAH) --}}
            <div class="w-20 h-20 overflow-hidden border border-gray-300 rounded-full shadow md:w-24 md:h-24">
                <img src="{{ $user->profileSetting?->profile_picture ? asset('storage/' . $user->profileSetting->profile_picture) : $user->profile_photo_url }}"
                    alt="{{ $user->username }}" class="object-cover w-full h-full">
            </div>

            {{-- Info Profil & Posts --}}
            <div class="flex-1 mt-4 md:mt-0">
                <div class="flex flex-col mb-4 md:flex-row md:items-center md:space-x-6">
                    <h1 class="text-2xl font-semibold">{{ $user->username }}</h1>

                    @can('update', $user)
                        <a href="{{ route('profile.edit') }}"
                            class="px-4 py-1 mt-2 text-sm text-gray-700 border rounded hover:bg-gray-100 md:mt-0">
                            Edit Profile
                        </a>
                    @endcan
                </div>

                <div class="flex mb-4 space-x-6 text-sm text-gray-700">
                    <div><span class="font-semibold">{{ $user->mediaPosts->count() }}</span> posts</div>
                </div>

                <div class="space-y-1 text-sm text-gray-800">
                    @if ($user->name)
                        <div class="font-semibold">{{ $user->name }}</div>
                    @endif

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
        <div class="grid grid-cols-2 gap-4 mt-10 md:grid-cols-3">
            @forelse ($user->mediaPosts as $post)
                <div class="overflow-hidden border rounded">
                    @if ($post->media_type === 'image')
                        <img src="{{ asset('storage/' . $post->file_path) }}" class="object-cover w-full h-48">
                    @elseif ($post->media_type === 'video')
                        <video controls class="object-cover w-full h-48">
                            <source src="{{ asset('storage/' . $post->file_path) }}">
                        </video>
                    @endif
                    @if ($post->caption)
                        <div class="p-2 text-sm text-gray-600">{{ $post->caption }}</div>
                    @endif
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-full">Belum ada postingan.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
