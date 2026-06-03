@extends('layouts.app')

@section('content')
    <h1>Tambah Pengguna</h1>

    <div class="card">
        <form action="/users" method="POST">
            @csrf

            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}" style="width:100%; padding:8px;"><br>
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>

            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" style="width:100%; padding:8px;"><br>
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>

            <label>Password</label><br>
            <input type="password" name="password" style="width:100%; padding:8px;"><br>
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>

            <label>Role</label><br>
            <select name="role" style="width:100%; padding:8px;">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br><br>

            <button type="submit">Simpan</button>
            <a href="/users" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection