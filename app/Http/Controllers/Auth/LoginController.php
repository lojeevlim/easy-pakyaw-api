<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //custom login function
   public function login(Request $request){

    //create request validation 
    $validated = $request->validate([
     'email' => 'required|string',
     'password' => 'required|string'
    ]);

    //checking if user email is exist

    //validating if the user email and password are matched
    // if(!$user || !Hash::check($validated['password'], $user->password)){
    //  return response()->json([
    //   'message' => 'user does not exist!',
    //  ], 401);
    // }

   //checking user 
    if (!Auth::attempt($request->only('email', 'password'))) {
     return response()->json([
            'message' => 'user does not exist'
           ], 401);
    }
    
    //checking email
    $user = User::where('email', $validated['email'])->firstOrFail();

    //create token
    $token =  $user->createToken('token')->plainTextToken;

    //create response
    $response = [
     'user' => $user,
     'access_token' => $token,
     'token_type' => 'Bearer',
    ];

    //return response
    return response()->json($response, 200);
   }
}
