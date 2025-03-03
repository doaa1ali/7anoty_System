<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CemeteryController;
use App\Http\Controllers\Dashboard\HallController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\CartController;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

//HomePage....

Route::get('/' , [HomeController::class ,'index'])->name('home');
Route::get('service' , [HomeController::class ,'service'])->name('service');
Route::get('prayers', function () {return view('Layout_prayers.master');})->name('prayers');
Route::get('/cemetery' , [HomeController::class ,'cemetery'])->name('cemetery');
Route::get('/hall' , [HomeController::class ,'hall'])->name('hall');


//master Database....
Route::middleware(AdminMiddleware::class)->group(function () {

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
    Route::get('service/index', [ServiceController::class, 'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::delete('service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
    Route::get('service/show/{id}', [ServiceController::class, 'show'])->name('service.show');
    Route::get('service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('service/search', [ServiceController::class, 'search'])->name('service.search');

    //hall...
    Route::get('hall/index' ,[HallController::class ,'index'])->name('hall.index');
    Route::get('hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('hall/store', [HallController::class, 'store'])->name('hall.store');
    Route::get('hall/search', [HallController::class, 'search'])->name('hall.search');
    Route::get('hall/edit/{id}', [HallController::class, 'edit'])->name('hall.edit');
    Route::put('hall/update/{id}', [HallController::class, 'update'])->name('hall.update');
    Route::delete('hall/delete/{hall}', [HallController::class, 'destroy'])->name('hall.Delete');
    Route::get('hall/show/{id}', [HallController::class, 'show'])->name('hall.show');

      //cemetry......
      Route::get('cemetery/index' ,[CemeteryController::class ,'index'])->name('cemetery.index');
      Route::get('cemetery/search', [CemeteryController::class, 'search'])->name('cemetery.search');
      Route::get('cemetery/create', [CemeteryController::class, 'create'])->name('cemetery.create');
      Route::post('cemetery/store', [CemeteryController::class, 'store'])->name('cemetery.store');
      Route::get('cemetery/show/{id}', [CemeteryController::class, 'show'])->name('cemetery.show');
      Route::delete('cemetery/delete/{cemetery}', [CemeteryController::class, 'destroy'])->name('cemetery.Delete');
      Route::get('cemetery/edit/{id}', [CemeteryController::class, 'edit'])->name('cemetery.edit');
      Route::put('cemetery/update/{id}', [CemeteryController::class, 'update'])->name('cemetery.update');


      //Order......
      Route::get('order/index' ,[OrderController::class ,'index'])->name('order.index');

});


// Register Routes
Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'handleregister'])->name('auth.handleregister');

// Login Routes
Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'handlelogin'])->name('auth.handlelogin');

// Logout Route
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);



Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/add/{type}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{index}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

