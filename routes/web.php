<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Middleware para proteger el acceso al panel
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
        Route::get('/productos', [AdminController::class, 'productos'])->name('admin.productos');
        Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
    });
});
