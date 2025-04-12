<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Semua Postingan Media
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($posts as $post)
                <div class="overflow-hidden bg-white border rounded shadow-sm max-w-[500px] mx-auto">
                    <!-- Nama User -->
                    <div class="px-3 pt-2 text-sm font-semibold text-gray-800">
                        {{ $post->user->name }}
                    </div>

                    <!-- Media File -->
                    <div class="w-[500px] h-[500px] bg-gray-100 overflow-hidden flex items-center justify-center">
                        @if ($post->file_type === 'image')
                            <img src="{{ asset('storage/' . $post->file_path) }}" class="object-cover w-full h-full">
                        @elseif ($post->file_type === 'video')
                            <video controls class="object-cover w-full h-full">
                                <source src="{{ asset('storage/' . $post->file_path) }}">
                            </video>
                        @endif
                    </div>

                    <!-- Caption & Info -->
                    <div class="p-3 text-sm">
                        <p class="text-gray-700">{{ $post->caption }}</p>
                        <p class="mt-1 text-xs text-gray-500">
                            {{ $post->likes->count() }} Likes • {{ $post->comments->count() }} Comments
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-full">Belum ada postingan media.</div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
