@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Pengguna</h1>
        <p class="page-desc">Menambahkan akun admin baru ke dalam sistem.</p>
    </div>

    <div class="card">
        {{-- Form ini digunakan admin untuk membuat akun pengguna baru. --}}
        <form action="/users" method="POST">
            {{-- Token CSRF menjaga form dari request yang tidak sah. --}}
            @csrf

            <div class="form-group">
                <label>Nama</label>
                {{-- old('name') menjaga input tetap terisi jika validasi gagal. --}}
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama pengguna">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                {{-- Email harus valid dan tidak boleh sama dengan akun lain. --}}
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email pengguna">

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                {{-- Password akan diproses di controller sebelum disimpan ke database. --}}
                <input type="password" name="password" placeholder="Masukkan password">

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
                {{-- Role menentukan jenis akses pengguna di aplikasi. --}}
                <select name="role">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="/users" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
