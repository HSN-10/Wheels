<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GuestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(GuestController::class)->group(function(){
    Route::get('bodyType', 'getBodyType');
    Route::get('post/latest', 'lastPosts');
    Route::get('post/{id}', 'post');
    // TODO: NEED API FOR SEARCH
    Route::post('report/{id}', 'report');
});

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function(){
    Route::post('post/create', 'createPost');
    Route::put('post/{id}/edit', 'editPost');
    Route::post('counterOffer/{id}', 'counterOffer');
    Route::get('counterOffers', 'counterOffers');
    Route::post('alert/create', 'createAlert');
    Route::get('alerts', 'alerts');
    Route::put('profile/edit', 'updateProfile');
});
