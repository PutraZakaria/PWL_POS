@extends('layouts.app')

{{-- Customize layout sections --}}
@section('subtitle', 'Kategori')
@section('content_header_title', 'User dan Level')
@section('content_header_subtitle', 'Tambah')

{{-- Content body: main page content --}}
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User</h3>
            </div>

            <form method="post" action="">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode User</label>
                        <input type="text" class="form-control" id="kodeKategori" name="kategori_kode">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Nama User</label>
                        <input type="text" class="form-control" id="namaKategori" name="kategori_nama">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Level</h3>
            </div>

            <form method="post" action="">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Level</label>
                        <input type="text" class="form-control" id="kodeKategori" name="kategori_kode">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">Nama Level</label>
                        <input type="text" class="form-control" id="namaKategori" name="kategori_nama">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


{{-- @extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Level id</label><input type="text" class="form-control" placeholder="id">
                        <div>
                        </div>
                        <button type = "submit" class ="btn btn-info">Submit </button>
                    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop --}}
