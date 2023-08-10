<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [LoginController::class, 'SignUp']);
Route::post('/login', [LoginController::class, 'Login']);

Route::prefix('tasks')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [TasksController::class, 'store']);
    Route::put('/{task}', [TasksController::class, 'update']);
    Route::get('/{task}', [TasksController::class, 'show']);
    Route::delete('/{task}', [TasksController::class, 'destroy']);
});
