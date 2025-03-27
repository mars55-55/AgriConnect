<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompradorController extends Controller
{
    public function dashboard()
    {
        $pedidos = Pedido::where('usuario_id', Auth::id())->get();
        $productos = Producto::all();
        return view('comprador.dashboard', compact('pedidos', 'productos'));
    }
}
