@extends('layouts.app')

@section('content')
    <h1>Edit Pengguna</h1>

    <div class="card">
        <form action="/users/{{ $user->id_user }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" style="width:100%; padding:8px;"><br>
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>

            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width:100%; padding:8px;"><br>
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br>

            <label>Password Baru</label><br>
            <input type="password" name="password" style="width:100%; padding:8px;">
            <small>Kosongkan jika tidak ingin mengubah password.</small><br>
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br><br>

            <label>Role</label><br>
            <select name="role" style="width:100%; padding:8px;">
                <option value="">-- Pilih Role --</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <br><br>

            <button type="submit">Update</button>
            <a href="/users" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection