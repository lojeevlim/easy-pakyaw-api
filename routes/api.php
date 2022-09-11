<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//will modify the routes path later
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes
Route::post('/register',[RegisterController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);


//protected routes with token under sanctum middleware
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('/user', [UserController::class ,'index']);
    Route::post('/logout',[LogoutController::class, 'logout']);
} );