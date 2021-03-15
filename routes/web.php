<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\RequestFriends;
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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');

Route::get('/info-wall', [HomeController::class, 'infoWall']);

/*
 * Регистрация
 */
Route::name('auth.')
    ->prefix('auth')
    ->group(function () {
        /*
         * Регистрация
         */
        Route::get('signup', [AuthController::class, 'getSignup'])->middleware('guest')->name('signup');
        Route::post('signup', [AuthController::class, 'postSignup'])->middleware('guest');
        /*
         * Авторизация
         */
        Route::get('signin', [AuthController::class, 'getSignin'])->middleware('guest')->name('signin');
        Route::post('signin', [AuthController::class, 'postSignin'])->middleware('guest');
        /*
        * Выход
        */
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

/*
 * Поиск
 */
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

/*
* Загрузка аватарки
*/
Route::name('user.')
    ->prefix('user')
    ->group(function () {
        Route::get('{id}/avatar', [UserController::class, 'avatar'])->name('avatar');
        Route::post('{id}/upload-avatar', [UserController::class, 'uploadAvatar'])->name('upload-avatar');
        Route::get('{id}/wall-img', [UserController::class, 'imageWall'])->name('wall-img');
        Route::post('{id}/wall-img', [UserController::class, 'uploadImageWall']);
        Route::post('destroy', [UserController::class, 'destroy'])->name('destroy');
        Route::post('add-friend', [UserController::class, 'addFriend'])->name('add-friend');
        Route::post('send-request-friend', [UserController::class, 'sendRequestFriend'])->name('request-friend');

        Route::post('post',[UserController::class,'createPost'])->name('post');
    });

/*
 * Профили
 */
Route::name('profile.')
    ->prefix('profile')
    ->group(function () {
        Route::get('{id}', [ProfileController::class, 'index'])->name('index');
        Route::get('{id}/info', [ProfileController::class, 'edit'])->name('edit');
        Route::post('{id}/info-update', [ProfileController::class, 'update'])->name('update');
    });
