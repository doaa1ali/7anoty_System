<?php

// use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\TypeMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

//master....
Route::get('/', function () {
    return view('customerLayout.master');
})->name('home')->middleware(TypeMiddleware::class);

//register
Route::get('auth/register' ,[AuthController::class ,'register'])->name('auth.register');
Route::post('auth/register' ,[AuthController::class ,'handleregister'])->name('auth.handleregister');

//login
Route::get('auth/login' ,[AuthController::class ,'login'])->name('auth.login');
Route::post('auth/login' ,[AuthController::class ,'handlelogin'])->name('auth.handlelogin');

//logout
Route::get('auth/logout' ,[AuthController::class ,'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);




