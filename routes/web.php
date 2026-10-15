<?php

use Illuminate\Support\Facades\Route;

// Route::livewire('/', 'pages::users.index');

// Route::livewire('/students', 'pages::students.index');

Route::middleware('auth')->group(function () {
    Route::livewire('/', 'pages::users.index');
    Route::livewire('/students', 'pages::students.index');
});