<?php

use App\Http\Controllers\BodyTypeController;
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
        Route::delete('/{id}/forceDelete', 'forceDelete')->name('bodytype.forceDelete');
    });

});
