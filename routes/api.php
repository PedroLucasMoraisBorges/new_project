<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

// READ
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

// CREATE
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// UPDATE
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

Route::put('/tasks/complete/{id}', [TaskController::class, 'complete'])->name('tasks.complete');

// DELETE
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
