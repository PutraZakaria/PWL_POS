<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        <tr>
            <td>{{ $data->user_id}}</td>
            <td>{{ $data->username}}</td>
            <td>{{ $data->nama}}</td>
            <td>{{ $data->level_id}}</td>
        </tr>
        {{-- @foreach ($data as $d)
        @endforeach --}}

        {{-- Untuk Menampilkan Hasil Count --}}
        {{-- <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <th>
                {{$data}}
            </th>
        </tr> --}}

    </table>
</body>
</html>