<?php

use App\Http\Controllers\Admin\{TaskController, UserController, ToolController};
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::post('/', [UserController::class, 'createOrUpdate']);
    Route::get('/{id}/delete', [UserController::class, 'delete']);
});

Route::prefix('tool')->group(function() {
    Route::get('/', [ToolController::class, 'index'])->name('tool.index');
    Route::post('/', [ToolController::class, 'createOrUpdate']);
    Route::get('/{id}/delete', [ToolController::class, 'delete']);
});

Route::prefix('task')->group(function() {
    Route::get('/', [TaskController::class, 'index'])->name('task.index');
    Route::get('/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/', [TaskController::class, 'createOrUpdate']);
    Route::get('/{id}/delete', [TaskController::class, 'delete']);
});

Auth::routes();
