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
Route::get('corporate/register', 'Corporate\AuthController@register')->name('corporate.register');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('dashboard/hire/select-type', 'User\DriverController@selectHireType')->name('user.hire-type');
    Route::get('dashboard/{hireType}/drivers', 'User\DriverController@list')->name('user.drivers');
    Route::get('dashboard/{hireType}/drivers/hire', 'User\DriverController@hireDriver')->name('user.hire-driver');
    Route::post('dashboard/drivers/hire', 'User\DriverController@hireDriverPayment')->name('user.hire-driver-payment');
    Route::get('dashboard/{hireType}/drivers/{id}', 'User\DriverController@showDriver')->name('user.driver');
    Route::get('cart/{id}/add', 'User\DriverController@addToCart')->name('user.cart.add');
    Route::get('cart/{id}/remove', 'User\DriverController@removeFromCart')->name('user.cart.remove');
    Route::get('dashboard/{hireType}/cart', 'User\DriverController@viewCart')->name('user.cart');

    Route::get('dashboard/driver/complete-registration', 'Driver\RegistrationController@completeRegistration')
        ->middleware('auth')->name('driver.complete-registration');
    Route::post('driver/register/complete', 'Driver\RegistrationController@submitRegistration')->name('driver.register.compete');
    Route::post('driver/register/resubmit', 'Driver\RegistrationController@resubmitRegistration')->name('driver.register.resubmit');

    Route::get('dashboard/admin/drivers/{id}', 'Admin\DriverController@view')->name('admin.driver');
    Route::get('dashboard/admin/drivers/{id}/approve', 'Admin\DriverController@approveDriver')->name('admin.driver.approve');
    Route::post('dashboard/admin/drivers/{id}/reject', 'Admin\DriverController@rejectApproval')->name('admin.driver.reject');
    Route::get('dashboard/admin/drivers/{id}/revoke', 'Admin\DriverController@revokeApproval')->name('admin.driver.revoke');
    Route::get('dashboard/admin/hire-request/{id}', 'Admin\DriverHireController@hireRequest')->name('admin.hire-request');
    Route::get('dashboard/admin/hire-request/{id}/approve', 'Admin\DriverHireController@approveRequest')->name('admin.hire-request.approve');
    Route::get('dashboard/admin/hire-request/{id}/decline', 'Admin\DriverHireController@declineRequest')->name('admin.hire-request.decline');
    Route::get('dashboard/admin/hire-request/{id}/terminate', 'Admin\DriverHireController@terminateEmployment')->name('admin.hire-request.terminate');
});

