@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/penjualan/' . $penjualan->penjualan_id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!} <!-- Add this line to use the PUT method for editing -->

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                            @error('penjualan_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pembeli</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="pembeli" name="pembeli"
                                value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                            @error('pembeli')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Petugas</label>
                        <div class="col-11">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Pilih Petugas -</option>
                                @foreach ($user as $user)
                                    <option value="{{ $user->user_id }}" @if ($user->user_id == $penjualan->user_id) selected @endif>{{ $user->nama }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal</label>
                        <div class="col-11">
                            <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                   value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal ? \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d\TH:i') : '') }}" required>
                            @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Detail Barang</label>
                        <div class="col-11">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penjualan->penjualan_detail as $detail)
                                        <tr>
                                            <td>{{ $detail->barang_id }}</td>
                                            <td>{{ $detail->barang->barang_nama }}</td>
                                            <td><input type="number" name="harga[]" value="{{ old('harga', $detail->harga) }}" class="form-control"></td>
                                            <td><input type="number" name="jumlah[]" value="{{ old('jumlah', $detail->jumlah) }}" class="form-control"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm" >Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
