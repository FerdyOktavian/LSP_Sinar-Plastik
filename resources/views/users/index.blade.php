@extends('layouts.app')

@section('content')
    <h1>Manajemen Pengguna</h1>
    <p>Halaman ini digunakan untuk mengelola data pengguna sistem.</p>

    <div class="card">
        <a href="/users/create">+ Tambah Pengguna</a>
        <br><br>
        {{-- Pesan error khusus halaman user, misalnya saat akun tidak boleh dihapus. --}}
        @if (session('error'))
            <div style="color:red; margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif
        {{-- Tabel menampilkan daftar pengguna dan aksi untuk mengubah atau menghapus data. --}}
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse menampilkan data user jika ada, atau pesan kosong jika belum ada data. --}}
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="/users/{{ $user->id_user }}/edit">Edit</a>

                            <form action="/users/{{ $user->id_user }}" method="POST" style="display:inline;">
                                @csrf
                                {{-- Method DELETE dipakai untuk proses hapus pengguna. --}}
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">Data pengguna belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
