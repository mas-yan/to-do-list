<?php

use App\Http\Controllers\TodoController;
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

Route::get('to-do-list', [TodoController::class, 'index']);
Route::post('to-do-list', [TodoController::class, 'store']);
Route::get('to-do-list/{id}', [TodoController::class, 'show']);
Route::put('to-do-list/{id}', [TodoController::class, 'update']);
Route::delete('to-do-list/{id}', [TodoController::class, 'destroy']);
