<?php

use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\BodyTypeController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::prefix('dashboard')->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', 'index')->name('dashboard');
    });
    Route::controller(BodyTypeController::class)->prefix('BodyType')->group(function(){
        Route::get('/', 'index')->name('bodytype.index');
        Route::get('/create', 'create')->name('bodytype.create');
        Route::post('/create', 'store')->name('bodytype.store');
        Route::get('/{bodyType}/edit', 'edit')->name('bodytype.edit');
        Route::put('/{bodyType}/edit', 'update')->name('bodytype.update');
        Route::delete('/{bodyType}', 'destroy')->name('bodytype.destroy');
        Route::get('/trash', 'trash')->name('bodytype.trash');
        Route::get('/{id}/undo', 'undo')->name('bodytype.undo');
    });

    Route::controller(UserController::class)->prefix('User')->group(function(){
        Route::get('/', 'index')->name('user.index');
        Route::get('/{user}/edit', 'edit')->name('user.edit');
        Route::put('/{user}/edit', 'update')->name('user.update');
        Route::delete('/{user}', 'destroy')->name('user.destroy');
        Route::get('/trash', 'trash')->name('user.trash');
        Route::get('/{id}/undo', 'undo')->name('user.undo');
    });

    Route::controller(PostController::class)->prefix('Post')->group(function(){
        Route::get('/', 'index')->name('post.index');
        Route::get('/{post}/edit', 'edit')->name('post.edit');
        Route::put('/{post}/edit', 'update')->name('post.update');
        Route::delete('/{post}', 'destroy')->name('post.destroy');
        Route::get('/trash', 'trash')->name('post.trash');
        Route::get('/{id}/undo', 'undo')->name('post.undo');
    });

});
