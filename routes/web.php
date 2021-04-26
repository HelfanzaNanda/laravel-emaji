<?php

use App\Http\Controllers\Admin\{FileController, TaskController, TaskResultController, UserController, ToolController};
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
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
        //Route::get('/', [TaskController::class, 'index'])->name('task.index');
        Route::get('/create', [TaskController::class, 'create'])->name('task.create');
        Route::post('/', [TaskController::class, 'createOrUpdate']);
        Route::get('/{toolId}', [TaskController::class, 'detail'])->name('task.detail');
        Route::get('/{taskId}/delete', [TaskController::class, 'delete']);
    });
    
    Route::prefix('task-result')->group(function() {
        Route::get('/', [TaskResultController::class, 'index'])->name('task.result.index');
    });

    Route::prefix('file')->group(function() {
        Route::get('/', [FileController::class, 'index'])->name('file.index');
        Route::post('/', [FileController::class, 'createOrUpdate']);
        Route::get('/{id}/delete', [FileController::class, 'delete']);
    });
});

Auth::routes();
