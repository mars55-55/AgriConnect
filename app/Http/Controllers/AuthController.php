<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Confirmación de contraseña
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Determinar la redirección según el rol del usuario
            $redirectUrl = '';
            switch ($user->role) {
                case 'admin':
                    $redirectUrl = route('admin.dashboard'); // Ruta para el dashboard del admin
                    break;
                case 'agricultor':
                    $redirectUrl = route('agricultor.dashboard'); // Ruta para el dashboard del agricultor
                    break;
                case 'comprador':
                    $redirectUrl = route('comprador.dashboard'); // Ruta para el dashboard del comprador
                    break;
                default:
                    $redirectUrl = route('home'); // Ruta por defecto
                    break;
            }

            // Respuesta JSON con la URL de redirección
            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso.',
                'redirect_url' => $redirectUrl,
            ]);
        }

        // Respuesta en caso de error
        return response()->json([
            'success' => false,
            'message' => 'Credenciales incorrectas.',
        ], 401);
    }

    // Perfil del usuario autenticado
    public function userProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado.'], 401);
        }

        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ], 200);
    }
}