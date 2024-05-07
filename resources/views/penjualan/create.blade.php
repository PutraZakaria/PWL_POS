@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                            value="{{ old('penjualan_kode') }}" required>
                        @error('penjualan_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Pembeli</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="pembeli" name="pembeli"
                            value="{{ old('pembeli') }}" required>
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
                            @foreach ($user as $usr)
                                <option value="{{ $usr->user_id }}">{{ $usr->nama }}</option>
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
                            value="{{ old('penjualan_tanggal') }}" required>
                        @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Detail Barang</label>
                    <div class="col-11">
                        <table id="detail_barang_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="barang_id[]" class="form-control">
                                            <option value="" disabled>- Pilih Nama Barang -</option>
                                            @foreach ($barang as $brg)
                                                <option value="{{ $brg->barang_id }}">{{ $brg->barang_nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="jumlah[]" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success btn-sm" id="add_row">Tambah Baris</button>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#add_row').click(function() {
                var html = '<tr>' +
                    '<td><select name="barang_id[]" class="form-control"><option>- Pilih Nama Barang -</option>@foreach ($barang as $brg)<option value="{{ $brg->barang_id }}">{{ $brg->barang_nama }}</option>@endforeach</select></td>' +
                    '<td><input type="number" name="jumlah[]" class="form-control"></td></tr>';
                $('#detail_barang_table').append(html);
            });
        });

        $(document).on('change', '.barang_nama', function() {
            // Dapatkan harga dari atribut data-harga pada opsi yang dipilih
            var harga = $(this).find(':selected').data('harga');
            // Isi input harga yang sesuai dengan harga yang ditemukan
            $(this).closest('tr').find('.harga').val(harga);
        });
    </script>
@endpush
