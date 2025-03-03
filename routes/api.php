<?php

use App\Http\Controllers\Api\ApiHallController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiCemeteryController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiBookDurationController;
use App\Http\Controllers\Api\ApiDurationController;

use App\Http\Controllers\API;



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

//crud hall api
Route::post('hall/store', [ApiHallController::class, 'store']);
Route::get('hall/show/{id}', [ApiHallController::class, 'show']);
Route::post('hall/update/{id}', [ApiHallController::class, 'update']);
Route::delete('hall/delete/{id}', [ApiHallController::class, 'destroy']);


//crud duration api
Route::get('duration/index', [ApiDurationController::class, 'index']);
Route::get('duration/show/{id}', [ApiDurationController::class, 'show']);
Route::get('duration/delete/{id}', [ApiDurationController::class, 'destroy']);


//order_crud api
Route::get('order/index', [ApiOrderController::class, 'index']);
Route::get('order/show/{id}', [ApiOrderController::class, 'show']);
Route::get('order/delete/{id}', [ApiOrderController::class, 'destroy']);

//ask omar
Route::post('order/store', [ApiOrderController::class, 'store']);
Route::post('order/update/{id}', [ApiOrderController::class, 'update']);

//booking_crud api
Route::get('booking/index', [ApiBookDurationController::class, 'index']);
Route::post('booking/store', [ApiBookDurationController::class, 'store']);
Route::get('booking/show/{id}', [ApiBookDurationController::class, 'show']);
Route::post('booking/update/{id}', [ApiBookDurationController::class, 'update']);
Route::get('booking/delete/{id}', [ApiBookDurationController::class, 'destroy']);

//registration , login
Route::post('auth/register', [ApiAuthController::class,'handleregister']);
Route::post('auth/login', [ApiAuthController::class, 'handlelogin']);
// Crud_Api
Route::post('auth/store', [ApiAuthController::class, 'store']);
Route::post('auth/show/{id}', [ApiAuthController::class, 'show']);
Route::delete('auth/delete/{id}', [ApiAuthController::class, 'destroy']);
Route::post('auth/update/{id}', [ApiAuthController::class, 'update']);

//crud hall api
// Route::post('hall/store', [ApiHallController::class, 'store']);
// Route::get('hall/show/{id}', [ApiHallController::class, 'show']);
// Route::post('hall/update/{id}', [ApiHallController::class, 'update']);
// Route::delete('hall/delete/{id}', [ApiHallController::class, 'destroy']);




// //api crud operation for services
// Route::post('service/store', [ApiServiceController::class, 'store']);
// Route::get('service/show/{id}', [ApiServiceController::class, 'show']);
// Route::post('service/update/{id}', [ApiServiceController::class, 'update']);
// Route::delete('service/delete/{id}', [ApiServiceController::class, 'destroy']);
    

