<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\m_penjualan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return m_penjualan::all();
    }

    public function store(Request $request)
    {
        $transaksi = m_penjualan::create($request->all());
        return response()->json($transaksi, 201);
    }

    public function show($transaksi)
    {
        return m_penjualan::find($transaksi);
    }

    public function Update(Request $request, m_penjualan $transaksi)
    {
        $transaksi->update($request->all());
        return m_penjualan::find($transaksi);
    }

    public function destroy(m_penjualan $transaksi)
    {
        $transaksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
