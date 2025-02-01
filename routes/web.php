<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::view('viewAbsences', 'viewAbsences')
    ->middleware(['auth'])
    ->name('viewAbsences');
Route::view('viewUser', 'viewUser')
    ->middleware(['auth'])
    ->name('viewUser');
    Route::view('viewMyAbsences', 'viewMyAbsences')
    ->middleware(['auth'])
    ->name('viewMyAbsences');
require __DIR__ . '/auth.php';
