<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//registration , login
Route::post('auth/register', [ApiAuthController::class,'handleregister']);
Route::post('auth/login', [ApiAuthController::class, 'handlelogin']);

// Crud_Api
Route::post('auth/store', [ApiAuthController::class, 'store']);
Route::post('auth/show/{id}', [ApiAuthController::class, 'show']);
Route::delete('auth/delete/{id}', [ApiAuthController::class, 'destroy']);
Route::post('auth/update/{id}', [ApiAuthController::class, 'update']);


