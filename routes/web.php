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
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);

// BAGIAN HALAMAN ADMIN YANG HARUS LOGIN
Route::middleware('auth')->group(function () {


    // BAGIAN ROUTES DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // BAGIAN ROUTES USER
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // BAGIAN ROUTES CATEGORIES
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // BAGIAN ROUTES PRODUCTS
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // BAGIAN ROUTES INVENTORY
    Route::get('/inventory', [InventoryController::class, 'index']);

    // BAGIAN ROUTES STOCK IN / BARANG MASUK
    Route::get('/stock-in', [StockInController::class, 'index']);
    Route::get('/stock-in/create', [StockInController::class, 'create']);
    Route::post('/stock-in', [StockInController::class, 'store']);

    // BAGIAN ROUTES STOCK OUT / BARANG KELUAR
    Route::get('/stock-out', [StockOutController::class, 'index']);
    Route::get('/stock-out/create', [StockOutController::class, 'create']);
    Route::post('/stock-out', [StockOutController::class, 'store']);

    // BAGIAN ROUTES REPORTS
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/print', [ReportController::class, 'print']);
    Route::get('/reports/pdf', [ReportController::class, 'pdf']);
    Route::get('/reports/excel', [ReportController::class, 'excel']);

    // BAGIAN LOGOUT
    Route::post('/logout', [AuthController::class, 'logout']);
});