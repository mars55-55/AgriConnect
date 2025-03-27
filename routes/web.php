<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgricultorController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\SharedController;

// Página principal
Route::get('/', function () {
    return view('home');
})->name('home');

// Ruta para la página de registro
Route::get('/register', function () {
    return view('auth.register'); // Asegúrate de tener esta vista creada
})->name('register')->middleware('guest');

// Ruta para la página de login
Route::get('/login', function () {
    return view('auth.login'); // Asegúrate de tener esta vista creada
})->name('login')->middleware('guest');

// Rutas de autenticación
Route::post('/api/login', [AuthController::class, 'login'])->name('login.api');
Route::post('/api/register', [AuthController::class, 'register'])->name('register.api');
Route::post('/login', [AuthController::class, 'login'])->name('login.api');

// Rutas protegidas por roles
Route::middleware(['auth'])->group(function () {
    // Rutas para administradores
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
        Route::get('/productos', [AdminController::class, 'productos'])->name('admin.productos');
        Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
    });

    // Rutas exclusivas para Agricultores
    Route::middleware(['role:agricultor'])->prefix('agricultor')->group(function () {
        Route::get('/dashboard', [AgricultorController::class, 'dashboard'])->name('agricultor.dashboard');
    });

    // Rutas exclusivas para compradores
    Route::middleware(['role:comprador'])->prefix('comprador')->group(function () {
        Route::get('/dashboard', [CompradorController::class, 'dashboard'])->name('comprador.dashboard');
    });
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/agricultor/dashboard', [AgricultorController::class, 'dashboard'])->name('agricultor.dashboard');
Route::get('/comprador/dashboard', [CompradorController::class, 'dashboard'])->name('comprador.dashboard');

