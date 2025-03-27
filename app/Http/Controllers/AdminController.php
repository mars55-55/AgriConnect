<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\Pedido;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usuarios = User::count();
        $productos = Producto::count();
        $pedidos = Pedido::count();

        return view('admin.dashboard', compact('usuarios', 'productos', 'pedidos'));
    }

    public function usuarios()
    {
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function productos()
    {
        $productos = Producto::all();
        return view('admin.productos', compact('productos'));
    }

    public function pedidos()
    {
        $pedidos = Pedido::with('detalles')->get();
        return view('admin.pedidos', compact('pedidos'));
    }
}
