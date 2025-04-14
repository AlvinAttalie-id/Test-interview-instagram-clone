<table>
    <thead>
        <tr>
            <th>Jenis</th>
            <th>Tanggal</th>
            <th>Caption</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ ucfirst($post->file_type) }}</td>
                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                <td>{{ $post->caption }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
