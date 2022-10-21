<?php

use App\Http\Controllers\API\AlertController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('bodyType', 'getBodyType');
    // TODO: NEED API FOR SEARCH
    Route::post('report/{post}', 'report');
});

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function(){
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::put('profile/edit', 'updateProfile');
});

Route::middleware('auth:sanctum')->controller(AlertController::class)->group(function(){
    Route::post('alert/create', 'createAlert');
    Route::get('alerts', 'alerts');
});

Route::controller(PostController::class)->group(function(){
    Route::get('post/latest', 'lastPosts');
    Route::get('post/{post}', 'post');

    Route::middleware('auth:sanctum')->group(function(){
        Route::post('post/create', 'create');
        Route::put('post/{post}/edit', 'edit');
        Route::delete('post/{post}/delete', 'delete');

        Route::post('counterOffer/{post}', 'counterOffer');
        Route::get('counterOffers', 'counterOffers');
    });
});
