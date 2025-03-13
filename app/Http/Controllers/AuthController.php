<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            "name"=>"required|string|max:300",
            "email"=>"required|string|max:300|email|unique:users",
            "password"=>"required|min:4"
        ]);

        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);

        return response()->json(['message'=>'nod 3la slaamtk'],201);
    }

    public function login(Request $request){

        $request->validate([
            "email"=>"required|string|max:300|email|unique:users",
            "password"=>"required|min:4"
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401); 
    }
        $user = $request->user();
        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'message' => 'Login fait',
            'token' => $token,
        ]);

    }

    public function logout(Request $request){
       $request->user()->tokens()->delete();
       return response()->json(['message'=>'khrj 3la slaamtk']);
    }
}