<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(){
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
}
