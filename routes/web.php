<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// BAGIAN LOGIN
// Route utama langsung mengarahkan pengguna ke halaman login.
Route::get('/', function () {
    return redirect('/login');
});

// Menampilkan form login.
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Memproses data email dan password dari form login.
Route::post('/login', [AuthController::class, 'prosesLogin']);

// BAGIAN HALAMAN ADMIN YANG HARUS LOGIN
// Semua route di dalam group ini hanya bisa diakses setelah pengguna login.
Route::middleware('auth')->group(function () {


    // BAGIAN ROUTES DASHBOARD
    // Menampilkan halaman ringkasan data persediaan.
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // BAGIAN ROUTES USER
    // Route untuk menampilkan, menambah, mengubah, dan menghapus data pengguna.
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // BAGIAN ROUTES CATEGORIES
    // Route untuk mengelola data kategori barang.
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // BAGIAN ROUTES PRODUCTS
    // Route untuk mengelola data barang, mulai dari daftar sampai hapus.
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // BAGIAN ROUTES INVENTORY
    // Menampilkan halaman persediaan barang tanpa proses tambah atau hapus.
    Route::get('/inventory', [InventoryController::class, 'index']);

    // BAGIAN ROUTES STOCK IN / BARANG MASUK
    // Route untuk melihat form dan menyimpan transaksi barang masuk.
    Route::get('/stock-in', [StockInController::class, 'index']);
    Route::get('/stock-in/create', [StockInController::class, 'create']);
    Route::post('/stock-in', [StockInController::class, 'store']);

    // BAGIAN ROUTES STOCK OUT / BARANG KELUAR
    // Route untuk melihat form dan menyimpan transaksi barang keluar.
    Route::get('/stock-out', [StockOutController::class, 'index']);
    Route::get('/stock-out/create', [StockOutController::class, 'create']);
    Route::post('/stock-out', [StockOutController::class, 'store']);

    // BAGIAN ROUTES REPORTS
    // Route laporan untuk tampil biasa, cetak, unduh PDF, dan unduh CSV.
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/print', [ReportController::class, 'print']);
    Route::get('/reports/pdf', [ReportController::class, 'pdf']);
    Route::get('/reports/excel', [ReportController::class, 'excel']);

    // BAGIAN LOGOUT
    // Logout memakai POST agar proses keluar dari akun lebih aman.
    Route::post('/logout', [AuthController::class, 'logout']);
});
