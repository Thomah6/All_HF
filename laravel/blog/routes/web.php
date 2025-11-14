<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\UserController;

Route::get('/', [PagesController::class, 'index']);


Route::get('/contact-us', [PagesController::class, 'contact']);
Route::get('/about', [PagesController::class, 'about']);

Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');
Route::get('/article/create', [ArticlesController::class, 'create'])->middleware('auth');
Route::post('/articles/create', [ArticlesController::class, 'store'])->middleware('auth');
Route::get('/article/{article}/edit', [ArticlesController::class, 'edit'])->middleware('auth');
Route::patch('/article/{article}/edit', [ArticlesController::class, 'update'])->middleware('auth')->name('articles.edit');
Route::delete('/article/{article}/delete', [ArticlesController::class, 'delete'])->middleware('auth');
Route::get('/article/{title}', [ArticlesController::class, 'show'])->name('articles.show');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::get('/login', [SessionsController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'authenticate'])->middleware('guest')->name('login');
Route::get('/profile', [UserController::class, 'index'])->middleware('auth')->name('profile');
Route::post('/logout', [SessionsController::class, 'logout'])->name('logout')->middleware('auth');



