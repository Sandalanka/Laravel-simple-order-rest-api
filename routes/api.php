<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 
Route::post('/user-register',[UserController::class,'store']);
Route::post('/user-login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/users',UserController::class);
    Route::get('/logout',[UserController::class,'logout']);
});



