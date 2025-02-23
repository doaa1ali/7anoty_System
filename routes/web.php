<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ServiceController;


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

    //hall
    Route::get('hall/index' ,[HallController::class ,'index'])->name('hall.index');
    Route::get('hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('hall/store', [HallController::class, 'store'])->name('hall.store');
    Route::get('hall/search', [HallController::class, 'search'])->name('hall.search');
    Route::get('hall/edit/{id}', [HallController::class, 'edit'])->name('hall.edit');
    Route::put('hall/update/{id}', [HallController::class, 'update'])->name('hall.update');
    Route::delete('hall/delete/{hall}', [HallController::class, 'destroy'])->name('hall.Delete');
    Route::get('hall/show/{id}', [HallController::class, 'show'])->name('hall.show');

});



//register
Route::get('auth/register' ,[AuthController::class ,'register'])->name('auth.register');
Route::post('auth/register' ,[AuthController::class ,'handleregister'])->name('auth.handleregister');

//login
Route::get('auth/login' ,[AuthController::class ,'login'])->name('auth.login');
Route::post('auth/login' ,[AuthController::class ,'handlelogin'])->name('auth.handlelogin');

//logout
Route::get('auth/logout' ,[AuthController::class ,'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);

//service type
Route::get('/service/type', [ServiceController::class, 'servicetype'])->name('service.type');
Route::post('/service/type', [ServiceController::class, 'servicehandle'])->name('service.handle');
Route::post('type/cemetry', [ServiceController::class, 'addcemetry'])->name('addcemetery');
Route::post('type/hall', [ServiceController::class, 'addhall'])->name('addhall');
Route::post('type/other', [ServiceController::class, 'addotherservice'])->name('addotherservice');




