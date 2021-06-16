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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'guest'], function() {

//    Route::get('/vk/auth', [\App\Http\Controllers\SocialController::class, 'redirectVK'])
//        ->name('auth.vkontakte');
//    Route::get('/vkontakte/auth/callback', [\App\Http\Controllers\SocialController::class, 'callbackVK']);

    Route::get('/github/auth', [\App\Http\Controllers\SocialController::class, 'redirectGH'])
        ->name('auth.github');
    Route::get('/github/auth/callback', [\App\Http\Controllers\SocialController::class, 'callbackGH']);
});

Route::get('/auth/facebook', [\App\Http\Controllers\SocialController::class, 'redirectFB'])
    ->name('auth.facebook');

Route::get('/auth/facebook/callback', [\App\Http\Controllers\SocialController::class, 'callbackFB']);

