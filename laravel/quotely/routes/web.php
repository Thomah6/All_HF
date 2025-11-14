<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\LikeController;

Route::get('/', [PagesController::class,'index'])->name('home');

Route::get('/login', [PagesController::class,'login'])->name('login');

Route::post('/login/authenticate', [AuthController::class,'authenticate'])->name('authenticate');

Route::get('/register', [PagesController::class,'register'])->name('register');

Route::post('/register/save', [AuthController::class,'save'])->name('save')->middleware('guest');

Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::get('/dashboard', [QuotesController::class,'index'])
    ->middleware('admin')
    ->name('dashboard');

Route::get('/create', [QuotesController::class,'create'])
    ->middleware('editor')
    ->name('create');

Route::post('/create/store', [QuotesController::class,'store'])
    ->middleware('editor')
    ->name('store');

Route::get('/edit/{quote}', [QuotesController::class,'edit'])
    ->middleware('editor')
    ->name('edit');

Route::patch('/edit/{quote}/update', [QuotesController::class,'update'])
    ->middleware('editor')
    ->name('update');

Route::get('/delete/{quote}', [QuotesController::class,'delete'])
    ->middleware('editor')
    ->name('delete');

Route::get('/users', [PagesController::class,'users'])->middleware('admin')->name('users');
Route::patch('/edit-role/{user}', [PagesController::class,'editRole'])->middleware('admin')->name('editRole');

Route::get('/profile', [PagesController::class,'profil'])->name('profil');

Route::post('/like', [LikeController::class,'like'])->name('like');
Route::post('/dislike', [LikeController::class,'dislike'])->name('dislike');

