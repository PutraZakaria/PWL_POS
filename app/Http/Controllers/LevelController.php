<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    public function index()
    {
        // DB FACADE
        // Insert
        // DB::insert('insert into m_levels(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // Update
        // $row = DB::update('update m_levels set level_nama = ? where level_kode = ?', ['Customer','CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: '.$row.' baris';

        // Delete
        // $row = DB::delete('delete from m_levels where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: '.$row.' baris';

        // Select
        $data = DB::select('select * from m_levels');
        return view('level', ['data' => $data]);
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        //The invoming request is valid...

        //Retrieve the validate input data...
        $validated = $request->validated();

        // Retrieve a portion  of the validated input data...
        $validated = $request->safe()->only(['level_kode', 'level_nama']);
        $validated = $request->safe()->except(['level_kode', 'level_nama']);

        // Store the post...
        return redirect('/level');
    }
}
