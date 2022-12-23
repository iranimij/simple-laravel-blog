<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index']);

Auth::routes();

//Route::middleware(['auth'])->group(function () {
//
//	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//	Route::get('/categories', [App\Http\Controllers\Admin\Categories::class, 'index'])->name('admin.categories');
//	Route::get('/categories', [App\Http\Controllers\Admin\Categories::class, 'index'])->name('admin.tags');
//
//});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home')->middleware('add.custom.header');
        Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
        Route::post('/category/new', [App\Http\Controllers\Admin\CategoryController::class, 'new'])->name('admin.category.new');
        Route::get('/tag', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tag');
        Route::post('/tag/new', [App\Http\Controllers\Admin\TagController::class, 'new'])->name('admin.tag.new');

        Route::get('/post', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.post')->middleware('add.custom.header');
        Route::post('/post/new', [App\Http\Controllers\Admin\PostController::class, 'new'])->name('admin.post.new');
    });
});

Route::get('/{slug}', [App\Http\Controllers\LandingPageController::class, 'get_news'])->where('slug', '(.*)');
