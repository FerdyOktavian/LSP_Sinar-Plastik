<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Persediaan Barang - Toko Sinar Plastik</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: white;
            padding: 22px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            padding: 10px 8px 22px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            margin-bottom: 20px;
        }

        .brand h2 {
            margin: 0;
            font-size: 19px;
            letter-spacing: 0.3px;
        }

        .brand p {
            margin: 6px 0 0;
            font-size: 13px;
            color: #cbd5e1;
        }

        .menu-section {
            margin-top: 18px;
            margin-bottom: 8px;
            padding-left: 8px;
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .menu a,
        .logout-button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 12px;
            margin-bottom: 5px;
            border-radius: 10px;
            color: #e5e7eb;
            text-decoration: none;
            font-size: 14px;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            font-family: "Segoe UI", Arial, sans-serif;
            transition: 0.2s;
        }
        .menu a.active {
            background: rgba(255,255,255,0.14);
            color: white;
            font-weight: 700;
        }
        .menu a:hover,
        .logout-button:hover {
            background: rgba(255,255,255,0.10);
            color: white;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-title h1 {
            margin: 0;
            font-size: 20px;
            color: #111827;
        }

        .topbar-title p {
            margin: 3px 0 0;
            font-size: 13px;
            color: #6b7280;
        }

        .admin-info {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 9px 14px;
            border-radius: 999px;
            font-size: 13px;
            color: #374151;
        }

        .content {
            padding: 28px;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .page-title {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            color: #111827;
        }

        .page-desc {
            margin: 7px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.04);
            margin-bottom: 22px;
        }

        .card h3 {
            margin-top: 0;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: #374151;
            font-weight: 700;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            padding: 13px 12px;
        }

        td {
            border-bottom: 1px solid #e5e7eb;
            padding: 12px;
            color: #374151;
        }

        tr:hover td {
            background: #f9fafb;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            font-size: 14px;
            font-family: "Segoe UI", Arial, sans-serif;
            outline: none;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-group {
            margin-bottom: 17px;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 9px;
            background: #2563eb;
            color: white;
            border: none;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-secondary {
            background: #6b7280;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-success {
            background: #059669;
        }

        .btn-warning {
            background: #d97706;
        }

        .btn-dark {
            background: #111827;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .text-danger {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .search-box {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            align-items: center;
        }

        .search-box input {
            max-width: 320px;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.04);
        }

        .stat-card .label {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 30px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
        }

        .stat-card .note {
            font-size: 13px;
            color: #6b7280;
        }
        @media (max-width: 900px) {
        .sidebar {
            width: 220px;
        }

        .main {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .content {
            padding: 18px;
        }
    }

    @media (max-width: 700px) {
        .app {
            display: block;
        }

        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }

        .main {
            margin-left: 0;
            width: 100%;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .topbar {
            height: auto;
            padding: 16px;
            align-items: flex-start;
            gap: 10px;
            flex-direction: column;
        }

        .search-box {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box input {
            max-width: 100%;
        }
    }
    </style>
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <h2>Sinar Plastik</h2>
            <p>Aplikasi Persediaan Barang</p>
        </div>

        <div class="menu">
            <div class="menu-section">Utama</div>
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>

            <div class="menu-section">Persediaan</div>
            <a href="/inventory" class="{{ request()->is('inventory') ? 'active' : '' }}">Persediaan Barang</a>
            <a href="/stock-in" class="{{ request()->is('stock-in*') ? 'active' : '' }}">Barang Masuk</a>
            <a href="/stock-out" class="{{ request()->is('stock-out*') ? 'active' : '' }}">Barang Keluar</a>

            <div class="menu-section">Master Data</div>
            <a href="/categories" class="{{ request()->is('categories*') ? 'active' : '' }}">Kategori Barang</a>
            <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">Daftar Barang</a>
            <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">Manajemen Pengguna</a>

            <div class="menu-section">Laporan</div>
            <a href="/reports" class="{{ request()->is('reports*') ? 'active' : '' }}">Laporan Persediaan</a>

            <div class="menu-section">Akun</div>
            <form action="/logout" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div class="topbar-title">
                <h1>Panel Admin Persediaan</h1>
                <p>Toko Sinar Plastik</p>
            </div>

            <div class="admin-info">
                {{ auth()->user()->name ?? 'Admin' }}
            </div>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>

</body>
</html>