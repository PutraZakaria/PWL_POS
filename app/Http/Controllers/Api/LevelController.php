<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\m_level;

class LevelController extends Controller
{
    public function index()
    {
        return m_level::all();
    }

    public function store(Request $request)
    {
        $level = m_level::create($request->all());
        return response()->json($level, 201);
    }

    public function show(m_level $level)
    {
        return m_level::find($level);
    }

    public function Update(Request $request, m_level $level)
    {
        $level->update($request->all());
        return m_level::find($level);
    }

    public function destroy(m_level $level)
    {
        $level->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
