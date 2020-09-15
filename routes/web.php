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
Route::get('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::get('register', 'AuthController@register')->name('register');
Route::get('driver/login', 'Driver\AuthController@login')->name('driver.login');
Route::get('driver/register', 'Driver\AuthController@register')->name('driver.register');

Route::post('login', 'AuthController@authenticate')->name('login');
Route::post('register', 'AuthController@registerUser');
Route::post('driver/register', 'Driver\AuthController@createDriver')->name('driver.register');
Route::post('driver/update', 'Driver\AuthController@update')->name('driver.update');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', 'DashboardController@index')->middleware('auth')->name('dashboard');
    Route::get('dashboard/drivers', 'User\DriverController@list')->middleware('auth')->name('user.drivers');
    Route::get('dashboard/drivers', 'User\DriverController@list')->middleware('auth')->name('user.drivers');

    Route::get('dashboard/driver/complete-registration', 'Driver\RegistrationController@completeRegistration')
        ->middleware('auth')->name('driver.complete-registration');
    Route::post('driver/register/complete', 'Driver\RegistrationController@submitRegistration')->name('driver.register.compete');
    Route::post('driver/register/resubmit', 'Driver\RegistrationController@resubmitRegistration')->name('driver.register.resubmit');

    Route::get('dashboard/admin/drivers/{id}', 'Admin\DriverController@view')->name('admin.driver');
    Route::get('dashboard/admin/drivers/{id}/approve', 'Admin\DriverController@approveDriver')->name('admin.driver.approve');
    Route::post('dashboard/admin/drivers/{id}/reject', 'Admin\DriverController@rejectApproval')->name('admin.driver.reject');
    Route::get('dashboard/admin/drivers/{id}/revoke', 'Admin\DriverController@revokeApproval')->name('admin.driver.revoke');
});

