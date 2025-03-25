<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

class InventarioController extends Controller
{
    public function index()
    {
        return response()->json(Inventario::all());
    }

    public function show($id)
    {
        return response()->json(Inventario::findOrFail($id));
    }

    public function store(Request $request)
    {
        $inventario = Inventario::create($request->all());
        return response()->json($inventario, 201);
    }

    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());
        return response()->json($inventario);
    }

    public function destroy($id)
    {
        Inventario::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
