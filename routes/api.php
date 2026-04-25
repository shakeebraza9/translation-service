<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Master\BlogCategoryController;
use App\Http\Controllers\Api\Master\BlogController;
use App\Http\Controllers\Api\Master\GlobalSettingsController;
use App\Http\Controllers\Api\Master\ProjectController;
use App\Http\Controllers\Api\Master\ProjectGalleryController;
use App\Http\Controllers\Api\PageController;


// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/setting', [GlobalSettingsController::class, 'index']);
Route::post('/supportForm',[PageController::class,'supportForm']);
Route::get('/project',[PageController::class,'projectForm']);
Route::get('/project/{slug}',[PageController::class,'singleProject']);
Route::get('/blogs',[PageController::class,'blogs']);
Route::get('/blogs/{slug}',[PageController::class,'singleBlog']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::prefix('admin')->group(function () {
        Route::resource('blogCategory',BlogCategoryController::class);
        Route::resource('blog',BlogController::class);
        Route::resource('settings',GlobalSettingsController::class);
        Route::resource('projects', ProjectController::class);


        Route::prefix('project-gallery')->group(function () {
            Route::post('/', [ProjectGalleryController::class, 'store']);
            Route::get('/{project_id}', [ProjectGalleryController::class, 'index']);
            Route::post('/update/{id}', [ProjectGalleryController::class, 'update']);
            Route::delete('/{id}', [ProjectGalleryController::class, 'destroy']);
        });

    });
});
// Route::get('/translations/export/json', [TranslationController::class, 'export']);