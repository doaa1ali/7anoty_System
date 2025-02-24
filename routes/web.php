<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\TypeMiddleware;
use Illuminate\Support\Facades\Route;

// HomePage Routes
Route::get('/', function () {
    return view('Layout_home.master');
})->name('home');

Route::get('service', function () {
    return view('Layout_service.master');
})->name('service');

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

    //services.....
    Route::get('service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('service/show/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::get('service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('service/search', [ServiceController::class, 'search'])->name('service.search');
   
});



// Register Routes
Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'handleregister'])->name('auth.handleregister');

// Login Routes
Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'handlelogin'])->name('auth.handlelogin');

// Logout Route
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);

//service type
Route::get('/service/type', [ServiceController::class, 'servicetype'])->name('service.type');
Route::post('/service/type', [ServiceController::class, 'servicehandle'])->name('service.handle');
Route::post('type/cemetry', [ServiceController::class, 'addcemetry'])->name('addcemetery');
Route::post('type/hall', [ServiceController::class, 'addhall'])->name('addhall');
Route::post('type/other', [ServiceController::class, 'addotherservice'])->name('addotherservice');

