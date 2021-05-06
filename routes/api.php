<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CyclesController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\TasksController;
use App\Http\Controllers\API\ToolsController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::get('tools', [ToolsController::class, 'index']);
Route::post('tools/{id}/validate', [ToolsController::class, 'validateQrCode']);
Route::get('cycles/{toolId}', [CyclesController::class, 'index']);
Route::get('tasks/{cycleId}/{toolId}', [TasksController::class, 'getTasks']);
Route::post('tasks/store', [TasksController::class, 'store']);
Route::get('files', [FileController::class, 'index']);
Route::get('history', [HistoryController::class, 'index']);


Route::middleware('auth:api')->group(function(){
    Route::get('user', function(Request $request){
        return $request->user();
    });
    Route::post('user/update/info', [UserController::class, 'updateInfo']);
    Route::post('user/update/password', [UserController::class, 'updatePassword']);
});
