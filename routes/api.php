<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\NotificacionController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::apiResource('/productos', ProductoController::class);
    Route::apiResource('/pedidos', PedidoController::class);
    Route::apiResource('/inventarios', InventarioController::class);
    Route::get('/notificaciones', [NotificacionController::class, 'index']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::middleware(['auth:api', 'role:agricultor'])->group(function () {
    Route::apiResource('/productos', ProductoController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/pedidos', [PedidoController::class, 'index']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::middleware(['auth:api', 'role:comprador'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index']);
    Route::post('/pedidos', [PedidoController::class, 'store']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});
