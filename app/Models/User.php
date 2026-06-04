<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Nama tabel yang menyimpan data pengguna.
    protected $table = 'users';

    // Primary key khusus karena tabel users memakai id_user.
    protected $primaryKey = 'id_user';

    // Kolom yang boleh diisi saat membuat atau mengubah pengguna.
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Kolom ini disembunyikan saat data user diubah menjadi array atau JSON.
    protected $hidden = [
        'password',
    ];
}
