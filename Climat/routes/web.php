<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MetiersController;
Route::get('/metiers/{id}/edit', [MetiersController::class, 'edit'])->name('metiers.edit');
Route::put('/metiers/{id}', [MetiersController::class, 'update'])->name('metiers.update');