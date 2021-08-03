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

Route::get('/', [App\Http\Controllers\CRM\UserController::class, 'index'])->name('users');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['role:admin','auth'])
    ->name('crm.')
    ->prefix('crm')
    ->group(static function() {
        Route::resource('users', \App\Http\Controllers\CRM\UserController::class);
        Route::resource('roles', \App\Http\Controllers\CRM\RoleController::class);
        Route::resource('products', \App\Http\Controllers\CRM\ProductControllerr::class);
        Route::resource('categories', \App\Http\Controllers\CRM\CategoryController::class);
        Route::resource('posts', \App\Http\Controllers\CRM\PostController::class);
    });

Route::middleware(['role:user','auth'])
    ->group(static function(){
        Route::get('/products', [\App\Http\Controllers\Site\SiteProductController::class, 'index'])->name('products');
        Route::get('/posts', [\App\Http\Controllers\Site\SitePostController::class, 'index'])->name('posts');
        Route::get('posts/{post}', '\App\Http\Controllers\Site\SitePostController@show');
    });

