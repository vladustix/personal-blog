<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('blog/posts', PostController::class)->names('blog.posts');

Route::resource('admin/blog/categories', CategoryController::class)
    ->only(['index', 'edit', 'create', 'update', 'store'])
    ->names('blog.admin.categories');
