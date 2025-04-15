<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Mari Berteman
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2>Daftar Pengguna</h2>
        <div class="space-y-4">
            @foreach ($users as $user)
                <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center space-x-4">
                        <!-- Menampilkan gambar profil jika ada, jika tidak tampilkan gambar inisial -->
                        <img src="{{ $user->profileSetting ? ($user->profileSetting->profile_picture ? asset('storage/' . $user->profileSetting->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&bold=true') : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&bold=true' }}"
                            alt="{{ $user->name }}" class="object-cover w-12 h-12 rounded-full">

                        <div>
                            <!-- Link ke Profil Pengguna -->
                            <a href="{{ route('user.profile', $user->username) }}"
                                class="font-semibold text-gray-800 hover:underline">
                                {{ $user->name }}
                            </a>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div>
                        @if ($user->is_followed)
                            <button type="button"
                                class="px-4 py-2 text-sm text-gray-800 bg-gray-300 rounded-lg cursor-default">
                                Followed
                            </button>
                        @else
                            <form method="POST" action="{{ route('follow', $user->id) }}">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                    Follow
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
