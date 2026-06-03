<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Persediaan Barang</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .navbar {
            height: 60px;
            background-color: #2c3e50;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .wrapper {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .sidebar {
            width: 230px;
            background-color: #34495e;
            color: white;
            padding-top: 20px;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 16px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 15px;
        }

        .sidebar a:hover {
            background-color: #2c3e50;
        }

        .content {
            flex: 1;
            padding: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        table {
            background: white;
            border-collapse: collapse;
        }

        th {
            background: #eeeeee;
        }

        th, td {
            padding: 8px;
        }

        .btn {
            display: inline-block;
            padding: 6px 10px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-secondary {
            background: #7f8c8d;
        }

        .btn-danger {
            background: #c0392b;
        }

        .btn-success {
            background: #16a085;
        }

        input, select, textarea {
            box-sizing: border-box;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="navbar">
        Aplikasi Persediaan Barang - Toko Sinar Plastik
    </div>

    <div class="wrapper">
        <div class="sidebar">
            <h3>Menu Admin</h3>

            <a href="/dashboard">Dashboard</a>
            <a href="/inventory">Persediaan Barang</a>
            <a href="/stock-in">Barang Masuk</a>
            <a href="/stock-out">Barang Keluar</a>
            <a href="/categories">Kategori Barang</a>
            <a href="/products">Daftar Barang</a>
            <a href="/users">Manajemen Pengguna</a>
            <a href="/reports">Laporan</a>
            <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" style="width:100%; padding:12px 20px; background:none; color:white; border:none; text-align:left; cursor:pointer;">
                    Logout
                </button>
            </form>
        </div>

        <div class="content">
            @if (session('success'))
                <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:4px;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>