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




//master Database....
Route::middleware(TypeMiddleware::class)->group(function () {
    //homeDatabase...
    Route::get('home/Database', function () { return view('Layout.master'); })->name('home.Database');
    //Users......
    Route::get('auth/index' ,[AuthController::class ,'index'])->name('auth.index');
    Route::get('auth/search', [AuthController::class, 'search'])->name('auth.search');
    Route::get('auth/create', [AuthController::class, 'create'])->name('auth.create');
    Route::post('auth/store', [AuthController::class, 'store'])->name('auth.store');
    Route::get('auth/show/{id}', [AuthController::class, 'show'])->name('auth.show');
    Route::delete('auth/delete/{user}', [AuthController::class, 'destroy'])->name('auth.Delete');
    Route::get('auth/edit/{id}', [AuthController::class, 'edit'])->name('auth.edit');
    Route::put('auth/update/{id}', [AuthController::class, 'update'])->name('auth.update');
   
});



//register
Route::get('auth/register' ,[AuthController::class ,'register'])->name('auth.register');
Route::post('auth/register' ,[AuthController::class ,'handleregister'])->name('auth.handleregister');

//login
Route::get('auth/login' ,[AuthController::class ,'login'])->name('auth.login');
Route::post('auth/login' ,[AuthController::class ,'handlelogin'])->name('auth.handlelogin');

//logout
Route::get('auth/logout' ,[AuthController::class ,'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);




