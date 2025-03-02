<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCemeteryController;
use App\Http\Controllers\Api\ApiServiceController;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//cemetery_crud api
Route::get('cemetery/index', [ApiCemeteryController::class, 'index']);
Route::post('cemetery/store', [ApiCemeteryController::class, 'store']);
Route::get('cemetery/show/{id}', [ApiCemeteryController::class, 'show']);
Route::post('cemetery/update/{id}', [ApiCemeteryController::class, 'update']);
Route::get('cemetery/delete/{id}', [ApiCemeteryController::class, 'destroy']);

//service_crud api
Route::get('service/index', [ApiServiceController::class, 'index']);
Route::post('service/store', [ApiServiceController::class, 'store']);
Route::get('service/show/{id}', [ApiServiceController::class, 'show']);
Route::post('service/update/{id}', [ApiServiceController::class, 'update']);
Route::get('service/delete/{id}', [ApiServiceController::class, 'destroy']);

//registration , login
Route::post('auth/register', [ApiAuthController::class,'handleregister']);
Route::post('auth/login', [ApiAuthController::class, 'handlelogin']);
// Crud_Api
Route::post('auth/store', [ApiAuthController::class, 'store']);
Route::post('auth/show/{id}', [ApiAuthController::class, 'show']);
Route::delete('auth/delete/{id}', [ApiAuthController::class, 'destroy']);
Route::post('auth/update/{id}', [ApiAuthController::class, 'update']);


