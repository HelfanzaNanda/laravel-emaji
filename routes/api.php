<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ToolsController;
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
Route::post('tools/validate', [ToolsController::class, 'store']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
