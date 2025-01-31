<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    //Ruta view registro de ausencias
Route::view('registerAbsences', 'registerAbsences')
    ->middleware(['auth'])
    ->name('registerAbsences');
require __DIR__ . '/auth.php';
