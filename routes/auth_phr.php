<?php

use App\Livewire\Contractors\Create;
use App\Livewire\Contractors\Edit;
use App\Livewire\Contractors\Index;
use App\Livewire\Contractors\Show;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/contractors', Index::class)
        ->name('contractors.index');

    Route::get('/contractors/create', Create::class)
        ->name('contractors.create');

    Route::get('/contractors/show/{contractor}', Show::class)
        ->name('contractors.show');

    Route::get('/contractors/update/{contractor}', Edit::class)
        ->name('contractors.edit');
});
