<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Mail\PedidoCreadoMail;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function index()
    {
        return response()->json(Pedido::all());
    }

    public function show($id)
    {
        return response()->json(Pedido::findOrFail($id));
    }

    public function store(Request $request)
    {
        // Validar los datos del pedido
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        // Crear el pedido
        $pedido = Pedido::create($request->all());

        // Enviar correo al administrador
        Mail::to('admin@agriconnect.com')->send(new PedidoCreadoMail($pedido));

        return response()->json($pedido, 201);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($request->all());
        return response()->json($pedido);
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
