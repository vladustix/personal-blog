<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\Blog\Admin\CategoryController as BlogAdminCategoryController;
use App\Http\Controllers\Blog\Admin\PostController as BlogAdminPostController;

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

// Route::get('/welcome', [App\Http\Controllers\MainController::class, 'welcome'])->name('welcome');

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('blog/posts', BlogPostController::class)->names('blog.posts');

Route::prefix('admin/blog/')->group(function() {

    // BlogCategory
    Route::resource('categories', BlogAdminCategoryController::class)
    ->only(['index', 'edit', 'create', 'update', 'store'])
    ->names('blog.admin.categories');

    // BlogPost
    Route::resource('posts', BlogAdminPostController::class)
    ->except(['show'])
    ->names('blog.admin.posts');
});
