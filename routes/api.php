<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Master\BlogCategoryController;
use App\Http\Controllers\Api\Master\BlogController;
use App\Http\Controllers\Api\Master\GlobalSettingsController;
use App\Http\Controllers\Api\Master\ProjectController;
use App\Http\Controllers\Api\PageController;


// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/setting', [GlobalSettingsController::class, 'index']);
Route::post('/supportForm',[PageController::class,'supportForm']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('admin')->group(function () {
        Route::resource('blogCategory',BlogCategoryController::class);
        Route::resource('blog',BlogController::class);
        Route::resource('settings',GlobalSettingsController::class);
        Route::resource('projects', ProjectController::class);

    });
});
// Route::get('/translations/export/json', [TranslationController::class, 'export']);