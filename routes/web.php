<?php

declare(strict_types=1);

use App\Livewire\Notes;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'))->name('home');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('notes')->name('notes.')->group(function () {
        Route::get('/',  Notes\Index::class)->name('index');
        Route::get('/create',      Notes\Create::class)->name('create');
        Route::get('/{note}',      Notes\Show::class)->name('show');
        Route::get('/{note}/edit', Notes\Edit::class)->name('edit');
    });
});

require __DIR__ . '/settings.php';
