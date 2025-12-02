<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// ===============================
// 🌍 Публичная часть (с локализацией)
// ===============================
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localeViewPath']
], function () {
    Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'anniversary'])->name('web.home');
    Route::get('/welcome', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.welcome');
    Route::get('/products', [App\Http\Controllers\Web\HomeController::class, 'categoryProducts'])->name('category.products');
    Route::get('/news', [App\Http\Controllers\Web\HomeController::class, 'allNews'])->name('web.allnews');
    Route::get('/about_us', [App\Http\Controllers\Web\HomeController::class, 'aboutUs'])->name('about_us');
    Route::get('/news/{news}', [App\Http\Controllers\Web\HomeController::class, 'showNews'])->name('web.news');
    Route::get('/privacy', [App\Http\Controllers\Web\HomeController::class, 'Privacy'])->name('web.privacy');
});


// ===============================
// 🔐 Админка (без локализации)
// ===============================
Route::prefix('admin')->group(function () {
    
    // Авторизация
    Auth::routes(['register' => true]);

    // Доступ только после входа
    Route::middleware(['auth'])->group(function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // CRUD ресурсы
        Route::resources([
            'categories' => App\Http\Controllers\CategoryController::class,
            'sliders'    => App\Http\Controllers\SliderController::class,
            'privacies'  => App\Http\Controllers\PrivacyController::class,
            'products'   => App\Http\Controllers\ProductController::class,
            'abouts'     => App\Http\Controllers\AboutController::class,
            'news'       => App\Http\Controllers\NewsController::class,
            'galleries'  => App\Http\Controllers\GalleryController::class,
        ]);

        // Менеджер файлов
        Route::get('filemanager', [App\Http\Controllers\FileManagerController::class, 'index'])->name('files.index');

        // Контакты (обратная связь)
        Route::get('contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('feedbacks.index');
        Route::delete('contacts/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('feedbacks.destroy');

        // Загрузка файлов из CKEditor / продуктов
        Route::post('news/upload', [App\Http\Controllers\NewsController::class, 'upload'])->name('ckeditor.upload');
        Route::post('products/upload', [App\Http\Controllers\ProductController::class, 'upload'])->name('products.upload');
    });
});

