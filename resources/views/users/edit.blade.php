@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Pengguna</h1>
        <p class="page-desc">Mengubah data akun pengguna sistem.</p>
    </div>

    <div class="card">
        {{-- Form update diarahkan ke akun yang sedang diedit berdasarkan id_user. --}}
        <form action="/users/{{ $user->id_user }}" method="POST">
            @csrf
            {{-- Method PUT digunakan untuk memperbarui data pengguna. --}}
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                {{-- old() memakai input sebelumnya, lalu fallback ke nama user dari database. --}}
                <input type="text" name="name" value="{{ old('name', $user->name) }}">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}">

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                {{-- Password boleh dikosongkan jika tidak ingin mengganti password lama. --}}
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
                {{-- Pilihan role otomatis mengikuti role user saat ini. --}}
                <select name="role">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="/users" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
