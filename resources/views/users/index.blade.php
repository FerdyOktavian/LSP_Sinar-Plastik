@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Manajemen Pengguna</h1>
        <p class="page-desc">Mengelola akun admin yang dapat mengakses aplikasi.</p>
    </div>

    <div class="card">
        <a href="/users/create" class="btn btn-success">+ Tambah Pengguna</a>

        <br><br>

        <div class="table-wrapper">
            {{-- Tabel menampilkan semua akun pengguna yang bisa mengakses aplikasi. --}}
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse menampilkan user jika ada, atau pesan kosong jika belum tersedia. --}}
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{-- ucfirst membuat teks role diawali huruf besar agar lebih rapi. --}}
                                <span class="badge badge-success">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/users/{{ $user->id_user }}/edit" class="btn btn-warning">
                                        Edit
                                    </a>

                                    <form action="/users/{{ $user->id_user }}" method="POST" style="margin:0;">
                                        @csrf
                                        {{-- Method DELETE digunakan untuk proses hapus pengguna. --}}
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;">Data pengguna belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
