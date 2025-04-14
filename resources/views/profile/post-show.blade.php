<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Postingan {{ $user->username }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-6 mx-auto">
        <div class="mb-4">
            <a href="{{ route('profile.page') }}" class="text-blue-600 hover:underline">&larr; Kembali ke profil</a>
        </div>

        <div class="post-card">
            <div class="post-username">
                {{ $user->name }}

                <!-- Titik Tiga untuk menu dropdown -->
                <div class="relative float-right dropdown">
                    <button class="text-gray-500" type="button" id="dropdownMenuButton" onclick="toggleDropdown(event)">
                        <i class="fas fa-ellipsis-h"></i> <!-- Titik tiga -->
                    </button>
                    <div id="dropdownMenu"
                        class="absolute right-0 hidden w-48 mt-2 bg-white rounded-lg shadow-lg dropdown-menu"
                        aria-labelledby="dropdownMenuButton">
                        <!-- Opsi untuk menghapus postingan -->
                        <form action="{{ route('profile.posts.delete', $post) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-sm text-gray-700 dropdown-item hover:bg-gray-200">Hapus
                                Postingan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="post-media-wrapper">
                @if ($post->file_type === 'image')
                    <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post image">
                @elseif ($post->file_type === 'video')
                    <video controls>
                        <source src="{{ asset('storage/' . $post->file_path) }}">
                    </video>
                @endif
            </div>

            <div class="mt-4 post-info">
                @if ($post->caption)
                    <p class="mb-2">{{ $post->caption }}</p>
                @endif
                <small>{{ $post->likes->count() }} Likes • {{ $post->comments->count() }} Comments</small>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/post-card.css') }}">
        <!-- Tambahkan stylesheet untuk dropdown -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script>
            // Fungsi untuk menampilkan atau menyembunyikan dropdown menu
            function toggleDropdown(event) {
                event.stopPropagation();
                let dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.classList.toggle('hidden'); // Menyembunyikan atau menampilkan dropdown
            }

            // Tutup dropdown jika klik di luar elemen
            document.addEventListener('click', function(event) {
                let dropdownMenu = document.getElementById('dropdownMenu');
                let button = document.getElementById('dropdownMenuButton');
                if (!button.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        </script>
    @endpush
</x-app-layout>
