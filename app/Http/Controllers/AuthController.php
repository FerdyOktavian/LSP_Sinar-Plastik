<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Menampilkan halaman form login.
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        // Memastikan email dan password wajib diisi sebelum proses login.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mengambil hanya data email dan password untuk dicocokkan dengan database.
        $credentials = $request->only('email', 'password');

        // Jika data login benar, session dibuat ulang agar lebih aman.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        // Jika login gagal, pengguna dikembalikan ke halaman sebelumnya dengan pesan error.
        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        // Menghapus status login pengguna dari aplikasi.
        Auth::logout();

        // Menghapus session lama dan membuat token baru setelah logout.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
