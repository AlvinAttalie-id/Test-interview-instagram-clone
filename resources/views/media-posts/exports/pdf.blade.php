<!DOCTYPE html>
<html>

<head>
    <title>PDF Archive</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h3>Media Post Archive</h3>
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
</body>

</html>
