<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\m_barang;

class BarangController extends Controller
{
    public function index()
    {
        return m_barang::all();
    }

    public function store(Request $request)
    {
        $barang = m_barang::create($request->all());
        return response()->json($barang, 201);
    }

    public function show($barang)
    {
        return m_barang::find($barang);
    }

    public function Update(Request $request, m_barang $barang)
    {
        $barang->update($request->all());
        return m_barang::find($barang);
    }

    public function destroy(m_barang $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
