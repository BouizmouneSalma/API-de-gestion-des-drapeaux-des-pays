<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
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
    public function login(Request $request)
    {
        try {
           $credentials  = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('MyApp')->plainTextToken;
    
                return response()->json([
                    'message' => 'Login réussi',
                    'user' => $user,
                    'token' => $token
                ]);
            }
    
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    public function logout(Request $request){
       $request->user()->tokens()->delete();
       return response()->json(['message'=>'khrj 3la slaamtk']);
    }
}