<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json([
            'message' => 'Lista de productos obtenida exitosamente',
            'data' => $productos
        ], 200);
    }

    public function show($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            return response()->json([
                'message' => 'Producto encontrado',
                'data' => $producto
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $producto = Producto::create($request->all());
        return response()->json([
            'message' => 'Producto creado exitosamente',
            'data' => $producto
        ], 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $producto = Producto::findOrFail($id);

            $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'descripcion' => 'nullable|string',
                'precio' => 'sometimes|required|numeric|min:0',
                'stock' => 'sometimes|required|integer|min:0',
            ]);

            $producto->update($request->all());
            return response()->json([
                'message' => 'Producto actualizado exitosamente',
                'data' => $producto
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->delete();
            return response()->json(['message' => 'Producto eliminado exitosamente'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }
}