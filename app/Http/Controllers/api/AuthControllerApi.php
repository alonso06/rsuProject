<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthControllerApi extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum', 'web']);
    // }

    public function login(Request $request)
    {
        try {
            $credenciales = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            if (Auth::attempt($credenciales)) {
                $user = Auth::user();
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $request->user()->tokens()->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['message' => 'Sesión cerrada exitosamente'], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function showUsers()
    {
        //TODO: Iniciar sesión
    }
}
