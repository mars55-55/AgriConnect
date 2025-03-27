<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class AgricultorController extends Controller
{
    public function dashboard()
    {
        $productos = Producto::where('agricultor_id', Auth::id())->get();
        return view('agricultor.dashboard', compact('productos'));
    }
}
