<?php

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

Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

Route::get('app_categories', [App\Http\Controllers\Api\CategoryController::class, 'app_categories']);

Route::get('categories/{category}', [App\Http\Controllers\Api\CategoryController::class, 'show']);

Route::get('home_sliders_web', [App\Http\Controllers\Api\GalleryController::class, 'sliders']);

Route::get('news',  [App\Http\Controllers\Api\NewsController::class, 'index']);

Route::get('latest_news',  [App\Http\Controllers\Api\NewsController::class, 'latest']);

Route::get('slider_news',  [App\Http\Controllers\Api\NewsController::class, 'slider_news']);

Route::get('news/{id}',  [App\Http\Controllers\Api\NewsController::class, 'show']);

Route::get('products', [App\Http\Controllers\Api\ProductController::class, 'index']);

Route::get('products/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);

Route::get('search', [App\Http\Controllers\Api\ProductController::class, 'search']);

Route::get('catalog_downloads', [App\Http\Controllers\FileManagerController::class, 'showFiles']);

Route::post('catalog_downloads/download', [App\Http\Controllers\FileManagerController::class, 'download']);

Route::get('galleries', [App\Http\Controllers\Api\GalleryController::class, 'index']);

Route::get('about_us', [App\Http\Controllers\Api\GalleryController::class, 'aboutus']);
Route::get('privacy', [App\Http\Controllers\Api\PrivacyController::class, 'index']);

Route::get('random_galleries', [App\Http\Controllers\Api\GalleryController::class, 'randomGalleries']);

Route::post('feedback', [App\Http\Controllers\ContactController::class, 'store']);

Route::post('feedback/{id}', [App\Http\Controllers\ContactController::class, 'destroy']);
