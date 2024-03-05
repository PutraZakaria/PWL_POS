<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        //  tambah data user dengan Eloquent Model-1 (Hasil error ngga ada data level_id 4) - Tapi bisa diatasi dengan menambah level
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4,
        // ];
        // UserModel::insert($data); // tambahkan data ke tabel m_users

        //  tambah data user dengan Eloquent Model-2
        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data); //Update data user

        // coba akses model UserModel
        // $user = UserModel::all();   //ambil semua data dari tabel m_users
        // return view('user', ['data' => $user]);

        // JOBSHEET 4
        // Praktikum 1
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // Praktikum 2 
        // FIND
        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);

        // FIRST
        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);

        // FIRST WHERE
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        // findOr
        $user = UserModel::findOr(20, ['username', 'nama'], function (){
            abort(404);
        });

        return view('user', ['data' => $user]);
    }
}