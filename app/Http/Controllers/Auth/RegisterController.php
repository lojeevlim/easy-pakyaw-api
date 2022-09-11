<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{

    //custom register function
    public function register(Request $request) {

      //create request validation 
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        $user = User::create([
            'name' =>  $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        //create token 
        $token = $user->createToken('token')->plainTextToken;

        //create response
        $response = [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        // return response
        return response()->json($response, 201);

    }
    
}
