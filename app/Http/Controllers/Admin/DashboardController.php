<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsuarios' => User::count(),
            'totalPedidos' => Pedido::count(),
            'totalProductos' => Producto::count(),
        ]);
    }
}

