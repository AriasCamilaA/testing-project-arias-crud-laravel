<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
Route::delete('/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/search', [TaskController::class, 'search'])->name('tasks.search');

