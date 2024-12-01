<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

// Not logged routes
Route::middleware([ CheckIsNotLogged::class ])->group(function() {
    // Auth routes
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});

// Login required routes
Route::middleware([ CheckIsLogged::class ])->group(function() {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

