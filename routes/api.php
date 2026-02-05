<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TranslationController;

Route::prefix('translations')->group(function () {
    Route::post('/', [TranslationController::class, 'store']);
    Route::put('{translation}', [TranslationController::class, 'update']);
    Route::get('/', [TranslationController::class, 'index']);
    Route::get('/search', [TranslationController::class, 'search']);
    Route::get('/export/json', [TranslationController::class, 'export']);
});