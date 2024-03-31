<?php

namespace App\Http\Controllers;

use App\Models\m_level;
use App\Models\m_user;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User'],
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem',
        ];

        $activeMenu = 'user';

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');

        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                $btn = '<a href="'. url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'. url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .url('/user/' . $user->user_id) . '">'
                . csrf_field() . method_field('DELETE') .
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = m_level::all();
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_users,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail User'
        ];

        $activeMenu = 'user';
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = m_level::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username'  => 'required|string|min:3|unique:m_users,username,'.$id.',user_id',
            'nama'      => 'required|string|max:100',
            'password'  => 'nullable|min:5',
            'level_id'  => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username'  => $request->username,
            'nama'      => $request->nama,
            'password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id'  => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        }

        try {
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
    // public function index()
    // {
    //     //  tambah data user dengan Eloquent Model-1 (Hasil error ngga ada data level_id 4) - Tapi bisa diatasi dengan menambah level
    //     // $data = [
    //     //     'username' => 'customer-1',
    //     //     'nama' => 'Pelanggan',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => 4,
    //     // ];
    //     // UserModel::insert($data); // tambahkan data ke tabel m_users

    //     //  tambah data user dengan Eloquent Model-2
    //     // $data = [
    //     //     'nama' => 'Pelanggan Pertama',
    //     // ];
    //     // UserModel::where('username', 'customer-1')->update($data); //Update data user

    //     // coba akses model UserModel
    //     // $user = UserModel::all();   //ambil semua data dari tabel m_users
    //     // return view('user', ['data' => $user]);

    //     // JOBSHEET 4
    //     // Praktikum 1
    //     // $data = [
    //     //     'level_id' => 2,
    //     //     'username' => 'manager_tiga',
    //     //     'nama' => 'Manager 3',
    //     //     'password' => Hash::make('12345'),
    //     // ];
    //     // UserModel::create($data);

    //     // $user = UserModel::all();
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.1
    //     // FIND
    //     // $user = UserModel::find(1);
    //     // return view('user', ['data' => $user]);

    //     // FIRST
    //     // $user = UserModel::where('level_id', 1)->first();
    //     // return view('user', ['data' => $user]);

    //     // FIRST WHERE
    //     // $user = UserModel::firstWhere('level_id', 1);
    //     // return view('user', ['data' => $user]);

    //     // findOr
    //     // $user = UserModel::findOr(20, ['username', 'nama'], function (){
    //     //     abort(404);
    //     // });
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.2
    //     // FindOrFail
    //     // $user = UserModel::findOrFail(1);
    //     // return view('user', ['data' => $user]);

    //     // FirstOrFail
    //     // $user = UserModel::where('username', 'manager9')->firstOrFail();
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.3
    //     // $user = UserModel::where('level_id', 2)->count();
    //     // // dd($user);
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.4
    //     // FirstOrCreate
    //     // $user = UserModel::firstOrCreate(
    //     //     [
    //     //         'username' => 'manager22',
    //     //         'nama' => 'Manager Dua Dua',
    //     //         'password' => Hash::make('12345'),
    //     //         'level_id' => 2,
    //     //     ],
    //     // );
    //     // return view('user', ['data' => $user]);

    //     // FirstOrNew
    //     // $user = UserModel::firstOrNew(
    //     //     [
    //     //         'username' => 'manager33',
    //     //         'nama' => 'Manager Tiga Tiga',
    //     //         'password' => Hash::make('12345'),
    //     //         'level_id' => 2,
    //     //     ],
    //     // );
    //     // $user->save();
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.5
    //     // IsDirty, IsClean
    //     // $user = UserModel::create([
    //     //     'username' => 'manager55',
    //     //     'nama' => 'Manager Lima Lima',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => 2,
    //     // ]);

    //     // $user->username = 'manager56';

    //     // $user->isDirty(); //True
    //     // $user->isDirty('username'); //True
    //     // $user->isDirty('nama'); //False
    //     // $user->isDirty(['nama','username']); //True

    //     // $user->isClean(); //False
    //     // $user->isClean('username'); //False
    //     // $user->isClean('nama'); //True
    //     // $user->isClean(['nama','username']); //False

    //     // $user->save();

    //     // $user->isDirty(); //False
    //     // $user->isClean(); //True
    //     // dd($user->isDirty());

    //     // WasChange
    //     // $user = UserModel::create([
    //     //     'username' => 'manager11',
    //     //     'nama' => 'Manager11',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => 2,
    //     // ]);

    //     // $user->username = 'manager12';
    //     // $user->save();

    //     // $user->wasChanged(); //True
    //     // $user->wasChanged('username'); //True
    //     // $user->wasChanged(['username', 'level_id']); //True
    //     // $user->wasChanged('nama'); //False
    //     // dd($user->wasChanged(['nama','username']));//True

    //     // Praktikum 2.6
    //     // $user = UserModel::all();
    //     // return view('user', ['data' => $user]);

    //     // Praktikum 2.7
    //     $user = UserModel::with('level')->get();
    //     return view('user', ['data' => $user]);
    //     // dd($user);

    // }

    // public function tambah(){
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request){
    //     UserModel::create([
    //         'username' => $request -> username,
    //         'nama' => $request -> nama,
    //         'password' => Hash::make($request->password),
    //         'level_id' => $request -> level_id,
    //     ]);
    //     return redirect('/user');
    // }

    // public function ubah($id){
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request){
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->level_id = $request->level_id;

    //     $user->save();
    //     return redirect('/user');
    // }

    // public function hapus($id){
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

    // public function store(StorePostRequest $request): RedirectResponse
    // {
    //     //The invoming request is valid...

    //     //Retrieve the validate input data...
    //     $validated = $request->validated();

    //     // Retrieve a portion  of the validated input data...
    //     $validated = $request->safe()->only(['username', 'nama', 'password', 'level_id']);
    //     $validated = $request->safe()->except(['username', 'nama', 'password', 'level_id']);

    //     // Store the post...
    //     return redirect('/user');
    // }
}
