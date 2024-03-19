<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
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

        // Praktikum 2.1
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
        // $user = UserModel::findOr(20, ['username', 'nama'], function (){
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        // Praktikum 2.2
        // FindOrFail
        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

        // FirstOrFail
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // return view('user', ['data' => $user]);

        // Praktikum 2.3
        // $user = UserModel::where('level_id', 2)->count();
        // // dd($user);
        // return view('user', ['data' => $user]);

        // Praktikum 2.4
        // FirstOrCreate
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ],
        // );
        // return view('user', ['data' => $user]);

        // FirstOrNew
        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ],
        // );
        // $user->save();
        // return view('user', ['data' => $user]);

        // Praktikum 2.5
        // IsDirty, IsClean
        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager Lima Lima',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);

        // $user->username = 'manager56';

        // $user->isDirty(); //True
        // $user->isDirty('username'); //True
        // $user->isDirty('nama'); //False
        // $user->isDirty(['nama','username']); //True

        // $user->isClean(); //False
        // $user->isClean('username'); //False
        // $user->isClean('nama'); //True
        // $user->isClean(['nama','username']); //False

        // $user->save();

        // $user->isDirty(); //False
        // $user->isClean(); //True
        // dd($user->isDirty());

        // WasChange
        // $user = UserModel::create([
        //     'username' => 'manager11',
        //     'nama' => 'Manager11',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);

        // $user->username = 'manager12';
        // $user->save();

        // $user->wasChanged(); //True
        // $user->wasChanged('username'); //True
        // $user->wasChanged(['username', 'level_id']); //True
        // $user->wasChanged('nama'); //False
        // dd($user->wasChanged(['nama','username']));//True

        // Praktikum 2.6
        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // Praktikum 2.7
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
        // dd($user);

    }

    public function tambah(){
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request){
        UserModel::create([
            'username' => $request -> username,
            'nama' => $request -> nama,
            'password' => Hash::make($request->password),
            'level_id' => $request -> level_id,
        ]);
        return redirect('/user');
    }

    public function ubah($id){
        $user = UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request){
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;

        $user->save();
        return redirect('/user');
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        //The invoming request is valid...

        //Retrieve the validate input data...
        $validated = $request->validated();

        // Retrieve a portion  of the validated input data...
        $validated = $request->safe()->only(['username', 'nama', 'password', 'level_id']);
        $validated = $request->safe()->except(['username', 'nama', 'password', 'level_id']);

        // Store the post...
        return redirect('/user');
    }
}
