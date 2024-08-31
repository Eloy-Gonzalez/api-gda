<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\AuthController;

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

Route::get('check', function () {
    return 'Alive';
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/test', function (Request $request) {
        return $request->user()->currentAccessToken();
    });
});

Route::middleware(['auth:sanctum'])->prefix('customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index']);
    Route::post('/', [CustomersController::class, 'store']);
    Route::delete('/', [CustomersController::class, 'update']);
});
