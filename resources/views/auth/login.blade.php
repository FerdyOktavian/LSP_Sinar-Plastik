<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Sinar Plastik</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111827;
        }

        .login-wrapper {
            width: 920px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0,0,0,0.25);
        }

        .login-info {
            background: #111827;
            color: white;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-info h1 {
            margin: 0;
            font-size: 32px;
            line-height: 1.2;
        }

        .login-info p {
            color: #cbd5e1;
            font-size: 15px;
            line-height: 1.7;
            margin-top: 18px;
        }

        .login-box {
            padding: 45px;
        }

        .login-box h2 {
            margin: 0;
            font-size: 26px;
            color: #111827;
        }

        .login-box .desc {
            margin: 8px 0 28px;
            color: #6b7280;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            margin-bottom: 14px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 6px;
        }

        button:hover {
            opacity: 0.92;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .text-danger {
            color: #dc2626;
            font-size: 13px;
            margin-top: -8px;
            margin-bottom: 10px;
        }

        .footer-note {
            margin-top: 20px;
            color: #6b7280;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>

{{-- Wrapper utama yang membagi halaman login menjadi area informasi dan form. --}}
<div class="login-wrapper">
    <div class="login-info">
        <h1>Aplikasi Persediaan Barang</h1>
        <p>
            Website ini digunakan untuk membantu Toko Sinar Plastik dalam mengelola data barang.
        </p>
    </div>

    <div class="login-box">
        <h2>Login Admin</h2>
        <div class="desc">Masukkan email dan password untuk mengakses sistem.</div>

        {{-- Menampilkan pesan error jika email atau password login salah. --}}
        @if (session('error'))
            <div class="error-box">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form login dikirim ke route /login untuk diproses oleh AuthController. --}}
        <form action="/login" method="POST">
            {{-- CSRF token wajib untuk melindungi form dari request yang tidak sah. --}}
            @csrf

            <label>Email</label>
            {{-- old('email') menjaga email tetap muncul jika validasi login gagal. --}}
            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@gmail.com">

            {{-- Menampilkan pesan validasi khusus untuk input email. --}}
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password">

            {{-- Menampilkan pesan validasi khusus untuk input password. --}}
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit">Masuk</button>
        </form>

        <div class="footer-note">
            Toko Sinar Plastik
        </div>
    </div>
</div>

</body>
</html>
