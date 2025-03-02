<?php

use App\Http\Controllers\Api\ApiHallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiOrderController;


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


<<<<<<< HEAD

Route::get('order/index', [ApiOrderController::class, 'index']);
=======
//crud hall api
Route::post('hall/store', [ApiHallController::class, 'store']);
Route::get('hall/show/{id}', [ApiHallController::class, 'show']);
Route::post('hall/update/{id}', [ApiHallController::class, 'update']);
Route::delete('hall/delete/{id}', [ApiHallController::class, 'destroy']);
>>>>>>> origin/hall_api_crud


