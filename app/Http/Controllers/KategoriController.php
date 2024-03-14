<?php

namespace App\Http\Controllers;
use App\DataTables\KategoriDataTable;
use App\Models\m_kategori;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable){
        return $dataTable->render('kategori.index');

        // Insert
        // $data = [
        //     'kategori_kode' => 'SNK',
        //     'kategori_nama' => 'Snack/Makanan Ringan',
        //     'created_at' => now(),
        // ];
        // DB::table('m_kategoris')->insert($data);
        // return 'Insert data baru berhasil';

        // Update
        // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';

        // Delete
        // $row = DB::table('m_kategoris')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: '.$row.' baris';

        // Select
        // $data = DB::table('m_kategoris')->get();
        // return view('kategori', ['data' => $data]);


    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        m_kategori::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }
}
