<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Arsip Postingan {{ $user->username }}
        </h2>
    </x-slot>

    <div class="max-w-4xl px-4 py-6 mx-auto">
        {{-- Navigasi kembali dan tombol ke halaman download arsip --}}
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('profile.page') }}" class="text-blue-600 hover:underline">&larr; Kembali ke profil</a>

            {{-- Tombol ke halaman arsip yang bisa didownload --}}
            <a href="{{ route('media-posts.archive') }}"
                class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                Download Arsip Saya
            </a>
        </div>

        <div class="mt-6">
            @if ($archivedPosts->isEmpty())
                <p class="text-gray-600">Tidak ada postingan yang diarsipkan.</p>
            @else
                <div class="mt-10 ig-grid">
                    @forelse ($archivedPosts as $post)
                        <a href="{{ route('profile.posts.show', $post) }}" class="relative ig-grid-item group">
                            @if ($post->file_type === 'image')
                                <img src="{{ asset('storage/' . $post->file_path) }}" alt="Post image">
                            @elseif ($post->file_type === 'video')
                                <video muted>
                                    <source src="{{ asset('storage/' . $post->file_path) }}">
                                </video>
                            @endif

                            <!-- Overlay untuk tombol -->
                            <div
                                class="absolute inset-0 flex items-center justify-center gap-4 transition-all duration-200 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100">
                                <form action="{{ route('profile.posts.restore', $post) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-sm text-white hover:underline">Restore</button>
                                </form>
                                <form action="{{ route('profile.posts.delete-permanent', $post) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-400 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-gray-500 col-span-full">Tidak ada postingan yang diarsipkan.</div>
                    @endforelse
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/ig-grid.css') }}">
    @endpush
</x-app-layout>
