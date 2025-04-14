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
                <label for="file" class="block text-sm font-medium text-gray-700">File Media (image/video)</label>

                <!-- Custom file input with Tailwind button style -->
                <label for="file"
                    class="inline-block px-4 py-2 mt-1 text-white bg-blue-600 rounded cursor-pointer hover:bg-blue-700">
                    Pilih File
                </label>
                <input type="file" name="file" id="file" class="hidden" onchange="previewMedia(event)">
                <p class="mt-2 text-sm text-gray-500">
                    Hanya file <strong>JPG, JPEG, PNG, MP4, MOV</strong>. Ukuran maksimal <strong>150MB</strong>.
                </p>
            </div>

            <!-- Preview Area -->
            <div id="media-preview" class="hidden mt-4">
                <p class="mb-2 text-sm font-medium text-gray-600">Preview:</p>
                <div id="preview-container" class="w-full max-w-md overflow-hidden border rounded">

                </div>
            </div>

            <div>
                <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
                <input type="text" name="caption" id="caption"
                    class="w-full mt-1 border-gray-300 rounded shadow-sm">
            </div>

            <div>
                <button type="submit" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Upload
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/media-preview.js') }}"></script>
    @endpush
</x-app-layout>
