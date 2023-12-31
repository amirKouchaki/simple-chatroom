<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('messages',[MessageController::class,'store'])->middleware('auth:sanctum');
Route::get('messages',[MessageController::class,'index'])->middleware('auth:sanctum');
Route::post('auth',[AuthenticationController::class,'registerAndLogin']);
