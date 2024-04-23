<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\m_kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return m_kategori::all();
    }

    public function store(Request $request)
    {
        $kategori = m_kategori::create($request->all());
        return response()->json($kategori, 201);
    }

    public function show(m_kategori $kategori)
    {
        return m_kategori::find($kategori);
    }

    public function Update(Request $request, m_kategori $kategori)
    {
        $kategori->update($request->all());
        return m_kategori::find($kategori);
    }

    public function destroy(m_kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
