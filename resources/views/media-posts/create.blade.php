<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Tambah Post Media
        </h2>
    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded">
                <ul class="pl-5 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('media-posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
                <input type="text" name="caption" id="caption"
                    class="w-full mt-1 border-gray-300 rounded shadow-sm">
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">File Media (image/video)</label>
                <input type="file" name="file" id="file" class="mt-1">
            </div>

            <div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Upload
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
