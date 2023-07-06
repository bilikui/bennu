<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'], 
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = User::where('username', $request->username)->first();

        if (is_null($user)) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario o contraseña incorrectos.'
            ]);
        }

        $user->tokens()->delete();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Usuario o contraseña incorrectos.'
            ]);
        }

        $token = $user->createToken($request->username)->plainTextToken;
        $arrToken = explode('|', $token);

        return response()->json([
            'status' => true,
            'message' => 'Se logeo con éxito.',
            'token' => $arrToken[1]
        ]);
    }

    public function logout()
    {  
        // Get the authenticated user
        $user = auth()->user();  
        // revoke the users token     
        $user->tokens()->delete(); 
           
        return response()->json([    
                'status' => true,        
                "message" => "Logged out successfully"        
            ], 
            200
        );    
    }
}