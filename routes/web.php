<?php

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

//master....
Route::get('/', function () {
    return view('Layout.master');
})->name('home');



//authors....
Route::get('author/index', [AuthorController::class, 'index'])->name('author.index');
Route::get('author/create', [AuthorController::class, 'create'])->name('author.create');
Route::post('author/store', [AuthorController::class, 'store'])->name("author.store");
Route::get('author/search', [AuthorController::class, 'search'])->name('author.search');
Route::get('author/edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
Route::put('author/edit/{author}', [AuthorController::class, 'update'])->name('author.update');
Route::delete('author/delete/{author}', [AuthorController::class, 'destroy'])->name('author.delete');
Route::get('author/show/{id}', [AuthorController::class, 'show'])->name("author.show");






