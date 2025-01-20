<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect root to tasks index
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Task routes
Route::resource('tasks', TaskController::class);
Route::patch('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])->name('tasks.toggle-complete');