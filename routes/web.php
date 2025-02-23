<?php

use App\Http\Controllers\AuthController;
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

Route::get('prayers', function () {
    return view('Layout_prayers.master');
})->name('prayers');

// Master Route
Route::get('/auth', function () {
    return view('customerLayout.master');
})->name('home/Database')->middleware(TypeMiddleware::class);

// Auth Routes
Route::get('auth/index', [AuthController::class, 'index'])->name('auth.index');

// Register Routes
Route::get('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/register', [AuthController::class, 'handleregister'])->name('auth.handleregister');

// Login Routes
Route::get('auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('auth/login', [AuthController::class, 'handlelogin'])->name('auth.handlelogin');

// Logout Route
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware(AuthMiddleware::class);

// Admin Dashboard Route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Creator Dashboard Route
Route::middleware(['auth', 'role:creator'])->group(function () {
    Route::get('/creator/dashboard', function () {
        return view('creator.dashboard');
    })->name('creator.dashboard');
});

// Service Routes
Route::middleware('auth')->group(function () {
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/{service}', [ServiceController::class, 'show'])->name('service.show');
});

Route::middleware(['auth', 'creator'])->group(function () {
    Route::resource('service', ServiceController::class)->except(['index', 'show']);
});
