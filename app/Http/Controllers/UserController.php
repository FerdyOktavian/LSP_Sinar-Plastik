<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/users')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . $id . ',id_user',
        'password' => 'nullable|min:6',
        'role' => 'required|max:20',
    ]);

    $user = User::findOrFail($id);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ];

    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect('/users')->with('success', 'Data pengguna berhasil diubah.');
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return redirect('/users')->with('error', 'Akun yang sedang login tidak boleh dihapus.');
        }

        if (User::count() <= 1) {
            return redirect('/users')->with('error', 'Minimal harus ada satu akun pengguna.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'Data pengguna berhasil dihapus.');
    }
}