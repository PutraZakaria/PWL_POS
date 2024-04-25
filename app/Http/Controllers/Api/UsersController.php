<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\m_user;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return m_user::all();
    }

    public function store(Request $request)
    {
        $user = m_user::create($request->all());
        return response()->json($user, 201);
    }

    public function show(m_user $user)
    {
        return m_user::find($user);
    }

    public function Update(Request $request, m_user $user)
    {
        $user->update($request->all());
        return m_user::find($user);
    }

    public function destroy(m_user $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}
