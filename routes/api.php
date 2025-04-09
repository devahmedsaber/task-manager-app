<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

// Auth Routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'as' => 'auth.'
], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Tasks Routes
Route::group([
    'middleware' => 'api',
    'prefix' => 'tasks',
    'as' => 'tasks.'
], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/{id}', [TaskController::class, 'show'])->name('show');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::post('/{id}', [TaskController::class, 'update'])->name('update');
    Route::put('/{id}/status', [TaskController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
});
