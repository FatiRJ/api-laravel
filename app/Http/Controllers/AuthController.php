<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\VerifyEmailNotification;
use App\Mail\VerifyEmail;
use App\Mail\confirmarCorreo;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    
    public function register(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            Mail::to($user->email)->send(new confirmarCorreo($user)); 
            return response()->json(['message' => 'User registered successfully'], 201);
        }
        else{
            return response()->json(['message' => 'User not registered'], 400);
        }
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validatedData)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Access Token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
