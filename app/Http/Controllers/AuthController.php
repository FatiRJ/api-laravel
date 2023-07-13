<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        // Validar las credenciales de inicio de sesión...

        $user = User::where('email', $request->email)->first();

        if (! $user || ! User::check($request->password, $user->password)) {
            // Las credenciales no son válidas...
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
