<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'))->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
