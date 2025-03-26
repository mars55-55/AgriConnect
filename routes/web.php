<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Ruta para la página de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/api/login', [AuthController::class, 'login'])->name('login1');
Route::post('/api/register', [AuthController::class, 'register'])->name('register.api');

// Middleware para proteger el acceso al panel de administración
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
        Route::get('/productos', [AdminController::class, 'productos'])->name('admin.productos');
        Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
    });
});

