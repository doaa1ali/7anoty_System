<?php


use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\TypeMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

//HomePage....
Route::get('/', function () {return view('Layout_home.master');})->name('home');
Route::get('service', function () {return view('Layout_service.master');})->name('service');
Route::get('prayers', function () {return view('Layout_prayers.master');})->name('prayers');




//master....
Route::get('/auth', function () {
    return view('customerLayout.master');
})->name('home/Database')->middleware(TypeMiddleware::class);

//User....
Route::get('auth/index' ,[AuthController::class ,'index'])->name('auth.index');

//register
Route::get('auth/register' ,[AuthController::class ,'register'])->name('auth.register');
Route::post('auth/register' ,[AuthController::class ,'handleregister'])->name('auth.handleregister');

//login
Route::get('auth/login' ,[AuthController::class ,'login'])->name('auth.login');
Route::post('auth/login' ,[AuthController::class ,'handlelogin'])->name('auth.handlelogin');

//logout
Route::get('auth/logout' ,[AuthController::class ,'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);




