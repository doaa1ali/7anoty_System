<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiCemeteryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//cemetery api
Route::get('cemetery/index', [ApiCemeteryController::class, 'index']);
Route::post('cemetery/store', [ApiCemeteryController::class, 'store']);
Route::get('cemetery/show/{id}', [ApiCemeteryController::class, 'show']);
Route::post('cemetery/update/{id}', [ApiCemeteryController::class, 'update']);
Route::get('cemetery/delete/{id}', [ApiCemeteryController::class, 'destroy']);

//registration
Route::post('auth/register', [ApiAuthController::class,'handleregister']);
Route::post('auth/login', [ApiAuthController::class, 'handlelogin']);
