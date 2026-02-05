<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TranslationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('translations')->group(function () {
        Route::post('/', [TranslationController::class, 'store']);
        Route::put('{translation}', [TranslationController::class, 'update']);
        Route::get('/', [TranslationController::class, 'index']);
        Route::get('/search', [TranslationController::class, 'search']);
    });
});
Route::get('/translations/export/json', [TranslationController::class, 'export']);