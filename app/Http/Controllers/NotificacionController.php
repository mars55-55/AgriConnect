<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;

class NotificacionController extends Controller
{
    public function index()
    {
        return response()->json(Notificacion::all());
    }

    public function show($id)
    {
        return response()->json(Notificacion::findOrFail($id));
    }

    public function store(Request $request)
    {
        $notificacion = Notificacion::create($request->all());
        return response()->json($notificacion, 201);
    }

    public function update(Request $request, $id)
    {
        $notificacion = Notificacion::findOrFail($id);
        $notificacion->update($request->all());
        return response()->json($notificacion);
    }

    public function destroy($id)
    {
        Notificacion::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
