<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function logout (Request $request){

        // // $user->tokens()->delete();
        //deleting all the tokens
        auth('sanctum')->user()->tokens()->delete();
        $response = [
            'mesaage' => 'logged out succesfully.'
        ];
        return response()->json($response, 200);
    }
}
