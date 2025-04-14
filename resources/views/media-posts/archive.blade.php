<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Data Media {{ auth()->user()->name ?? (optional($posts->first()->user)->name ?? 'Unknown User') }}
        </h2>

    </x-slot>

    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <form method="GET" action="{{ route('media-posts.archive') }}">
            <label>Dari: <input type="date" name="start_date" value="{{ request('start_date') }}"></label>
            <label>Sampai: <input type="date" name="end_date" value="{{ request('end_date') }}"></label>
            <button type="submit">Filter</button>
        </form>

        <div style="margin: 10px 0;">
            <a href="{{ route('media-posts.downloadArchive', request()->all() + ['format' => 'pdf']) }}">📄 Download
                PDF</a>
            |
            <a href="{{ route('media-posts.downloadArchive', request()->all() + ['format' => 'xlsx']) }}">📊
                Download
                XLSX</a>
        </div>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Media</th>
                    <th>Tanggal</th>
                    <th>Caption</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>
                            @if ($post->file_type == 'image')
                                <img src="{{ asset('storage/' . $post->file_path) }}" width="100">
                            @else
                                <video width="100" controls>
                                    <source src="{{ asset('storage/' . $post->file_path) }}">
                                </video>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                        <td>{{ $post->caption }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
