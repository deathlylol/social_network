<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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

Route::get('/',[HomeController::class,'index'])->name('home');

/*
 * Регистрация
 */
Route::get('/auth/signup',[AuthController::class,'getSignup'])->middleware('guest')->name('auth.signup');
Route::post('/auth/signup',[AuthController::class,'postSignup'])->middleware('guest');
/*
 * Авторизация
 */
Route::get('/auth/signin',[AuthController::class,'getSignin'])->middleware('guest')->name('auth.signin');
Route::post('/auth/signin',[AuthController::class,'postSignin'])->middleware('guest');

Route::get('/auth/logout',[AuthController::class,'logout'])->name('auth.logout');

/*
 * Поиск
 */
Route::get('/search',[SearchController::class,'index'])->name('search.index');

/*
 * Загрузка аватарки
 */
Route::get('/user/{id}/upload-avatar',[UserController::class,'index'])->name('user.index');
Route::post('/user/{id}/store',[UserController::class,'store'])->name('user.store');
Route::delete('/user/{id}/destroy',[UserController::class,'destroy'])->name('user.destroy');


/*
 * Профили
 */
Route::get('/user/{username}',[ProfileController::class,'index'])->name('profile.index');
Route::get('/user/{id}/info',[ProfileController::class,'edit'])->name('profile.edit');
Route::post('/user/{id}/info-update',[ProfileController::class,'update'])->name('profile.update');

