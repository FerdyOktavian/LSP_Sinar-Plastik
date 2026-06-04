<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Toko Sinar Plastik</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            width: 350px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 9px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    {{-- Kotak utama untuk form login pengguna. --}}
    <div class="login-box">
        <h2>Toko Sinar Plastik</h2>
        <p>Aplikasi Persediaan Barang</p>

        {{-- Menampilkan pesan error jika proses login gagal. --}}
        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form dikirim ke route login untuk memproses email dan password. --}}
        <form action="/login" method="POST">
            {{-- Token CSRF wajib ada agar form aman dari request palsu. --}}
            @csrf

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">

            {{-- Menampilkan pesan validasi khusus untuk input email. --}}
            @error('email')
                <div style="color:red; margin-bottom:10px;">{{ $message }}</div>
            @enderror

            <label>Password</label>
            <input type="password" name="password">

            {{-- Menampilkan pesan validasi khusus untuk input password. --}}
            @error('password')
                <div style="color:red; margin-bottom:10px;">{{ $message }}</div>
            @enderror

            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>
