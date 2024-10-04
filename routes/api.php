<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users',[UserController::class, 'index']);
Route::post('/create-user',[UserController::class, 'create']);
Route::get('/user/{id}',[UserController::class, 'view']);
Route::patch('/user-update/{id}',[UserController::class, 'update']);
Route::delete('/user-delete/{id}',[UserController::class,'delete']);


//The Endpoint 
/*

localhost:8000/api/

*/