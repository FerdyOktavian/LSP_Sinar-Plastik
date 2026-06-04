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
        // Mengambil semua data pengguna untuk ditampilkan di halaman daftar user.
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validasi input agar data user yang disimpan lengkap dan email tidak duplikat.
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|max:20',
        ]);

        // Menyimpan user baru, password harus di-hash agar tidak tersimpan sebagai teks biasa.
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
        // Mencari user berdasarkan id, jika tidak ada Laravel akan menampilkan error 404.
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
    // Validasi data update, email boleh sama jika masih milik user yang sedang diedit.
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|max:100|unique:users,email,' . $id . ',id_user',
        'password' => 'nullable|min:6',
        'role' => 'required|max:20',
    ]);

    $user = User::findOrFail($id);

    // Data utama yang akan diperbarui pada akun pengguna.
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ];

    // Password hanya diubah jika pengguna mengisi password baru.
    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    // Menyimpan perubahan data user ke database.
    $user->update($data);

    return redirect('/users')->with('success', 'Data pengguna berhasil diubah.');
    }

    public function destroy($id)
    {
        // Mencegah pengguna menghapus akun yang sedang dipakai untuk login.
        if (Auth::id() == $id) {
            return redirect('/users')->with('error', 'Akun yang sedang login tidak boleh dihapus.');
        }

        // Menjaga agar aplikasi tetap memiliki minimal satu akun pengguna.
        if (User::count() <= 1) {
            return redirect('/users')->with('error', 'Minimal harus ada satu akun pengguna.');
        }

        // Jika aman, data user dicari lalu dihapus dari database.
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
