<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\m_kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
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

    public function destroy($id)
    {
        $data = m_kategori::find($id);
        $data->delete();
        return redirect("/kategori")->with('success', 'Kategori berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        m_kategori::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect("/kategori");
    }

    public function edit($id)
    {
        $data = m_kategori::find($id);
        return view('kategori.edit', ['data' => $data]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'title' => 'bail|required|unique:posts|max:255',
    //         'body' => 'required',
    //     ]);
    //     return redirect('/kategori');
    // }

    public function store(StorePostRequest $request): RedirectResponse
    {
        //The invoming request is valid...

        //Retrieve the validate input data...
        $validated = $request->validated();

        // Retrieve a portion  of the validated input data...
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);

        // Store the post...
        return redirect('/kategori');
    }
}
