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

Route::get('/', 'AppController@index')->name('home');
Route::get('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::get('register', 'AuthController@register');
Route::get('driver/register', 'Driver\AuthController@register');

Route::post('login', 'AuthController@authenticate');
Route::post('register', 'AuthController@registerUser');
Route::post('driver/register', 'Driver\AuthController@createDriver')->name('driver.register');
Route::post('driver/update', 'Driver\AuthController@update')->name('driver.update');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', 'DashboardController@index')->middleware('auth')->name('dashboard');
});

