<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/offline', 'offline')->name('offline');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('transactions', 'transactions')->name('transactions');
    Route::view('analytics', 'analytics')->name('analytics');
    Route::view('budget', 'budget')->name('budget');
});

require __DIR__ . '/settings.php';
