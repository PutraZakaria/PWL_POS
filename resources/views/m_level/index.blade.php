@extends('layouts.app')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Data Level Pengguna</h2>
            </div>
            {{-- <div class="float-right">
                <a class="btn btn-success" href="{{ route('m_user.create') }}">Input User</a>
            </div> --}}
        </div>
    </div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th width="20px" class="text-center">ID</th>
        <th width="150px" class="text-center">Kode Level</th>
        <th width="200px" class="text-center">Nama Level</th>
        <th width="15px" class="text-center">Action</th>
    </tr>
    @foreach ($data as $d)
        <tr>
            <td>{{ $d->level_id}}</td>
            <td>{{ $d->level_kode}}</td>
            <td>{{ $d->level_nama}}</td>
            <td class="m auto">
                <a class="btn btn-primary btn-sm" >Edit</a>
                <a class="btn btn-danger btn-sm" >Hapus</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
