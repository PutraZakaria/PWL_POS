<?php

namespace App\Http\Controllers;

use App\Models\m_barang;
use App\Models\m_penjualan;
use App\Models\m_penjualan_detail;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan'],
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang terdaftar dalam sistem',
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();
        $barang = m_barang::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

//     public function list(Request $request)
// {
//     $penjualans = m_penjualan::select('penjualan_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal', 'petugas_id', 'barang_id')->with(['user', 'barang']);

//     return DataTables::of($penjualans)
//         ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
    //             $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
    //             $btn .= '<a href="' . url('/penjualan/' . $penjualan

    public function list(Request $request)
    {
        $penjualans = m_penjualan::select('penjualan_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal', 'user_id')
        ->with('user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah'],
        ];

        $page = (object) [
            'title' => 'Tambah penjualan baru',
        ];

        $user = UserModel::all();
        $barang = m_barang::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'penjualan_kode' => 'required',
            'pembeli' => 'required',
            'penjualan_tanggal' => 'required',
            'user_id' => 'required',
        ]);

        $penjualan = m_penjualan::create([
            'penjualan_kode' => $request->penjualan_kode,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'user_id' => $request->user_id,
        ]);

        // Simpan detail barang jika ada
        if ($request->barang_id && $request->jumlah ) {
            foreach ($request->barang_id as $key => $barang_id) {
                $barang = m_barang::find($barang_id);
                $harga = $barang->harga_jual;

                m_penjualan_detail::create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $barang_id,
                    'harga' => $harga,
                    'jumlah' => $request->jumlah[$key],
                ]);
            }
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function show(string $id)
    {
        $penjualan = m_penjualan::with('user')->find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail'],
        ];

        $page = (object) [
            'title' => 'Detail Penjualan',
        ];

        $activeMenu = 'penjualan';
        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $penjualan = m_penjualan::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit'],
        ];

        $page = (object) [
            'title' => 'Edit Penjualan',
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required',
            'user_id' => 'required',
        ]);

        // dd($request->all());

        try {
            DB::beginTransaction();

            m_penjualan::find($id)->update([
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
                'user_id' => $request->user_id,
            ]);

            if ($request->has('barang_nama') && $request->has('harga') && $request->has('jumlah')) {
                $harga = $request->harga;
                $jumlah = $request->jumlah;

                foreach ($harga as $key => $value) {
                    m_penjualan_detail::where('penjualan_id', $id)->update([
                        'harga' => $harga[$key],
                        'jumlah' => $jumlah[$key],
                    ]);
                }
            }

            DB::commit();

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/penjualan')->with('error', 'ERROR TOT');
        }

    }

    public function destroy(string $id)
    {
        $check = m_penjualan::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        }

        try {
            m_penjualan::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

}
