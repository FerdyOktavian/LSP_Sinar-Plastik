@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Pengguna</h1>
        <p class="page-desc">Menambahkan akun admin baru ke dalam sistem.</p>
    </div>

    <div class="card">
        <form action="/users" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama pengguna">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email pengguna">

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password">

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
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