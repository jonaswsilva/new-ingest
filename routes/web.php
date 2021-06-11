<?php

use App\Http\Controllers\{
    PostController,
    IngestController
};

use Illuminate\Support\Facades\Route;

Route::post('/ingests/rec', [IngestController::class, 'rec'])->name('ingests.rec');
Route::get('/ingests/stop', [IngestController::class, 'stop'])->name('ingests.stop');

Route::get('/ingests/scan', [IngestController::class, 'scanAllDir'])->name('ingests.scan');

Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts', [PostController::class, 'index' ])->name('posts.index');

Route::get('/', function () {
    return view('layouts/app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
