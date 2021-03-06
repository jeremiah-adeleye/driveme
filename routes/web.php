<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OnlineDriving;
use App\Http\Controllers\OnlineDrivingController;
use App\Http\Controllers\quizController;
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
Route::get('driver/register', 'Driver\AuthController@register')->name('driver.register');

Route::post('login', 'AuthController@authenticate')->name('login');
Route::post('register', 'AuthController@registerUser');
Route::post('driver/register', 'Driver\AuthController@createDriver')->name('driver.register');
Route::post('driver/update', 'Driver\AuthController@update')->name('driver.update');
Route::get('corporate/register', 'Corporate\AuthController@register')->name('corporate.register');
Route::post('corporate/register', 'Corporate\AuthController@saveCorporateUser')->name('corporate.register');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard',   [DashboardController::class,'index'])->name('dashboard');
    Route::get('dashboard/user/complete-registration', 'User\AccountController@completeRegistration')->name('user.complete-registration');
    Route::post('dashboard/user/complete-registration', 'User\AccountController@submitCompleteRegistration')->name('user.submit-complete-registration');

    Route::get('dashboard/corporate/complete-registration', 'Corporate\AccountController@completeRegistration')->name('corporate.complete-registration');
    Route::post('dashboard/corporate/complete-registration', 'Corporate\AccountController@submitCompleteRegistration')->name('corporate.submit-complete-registration');

    // Hire Vehicle here
    Route::get('dashboard/hire/select-type/vehicle', 'Vehicle\VehicleHireController@selectHireVehicleType')->name('select-vehicle-hire-type');

    Route::get('dashboard/view-single-vehicle/{id}', 'Vehicle\VehicleHireController@viewSingleVehicle')->name('view-single-vehicle');

    Route::post('hire/vehicle', 'Vehicle\VehicleHireController@hireVehicle')->name('hire-vehicle');
    //   Route::get('dashboard/{hireType}/drivers', 'DriverController@list')->name('user.drivers');
    //   Route::get('dashboard/{hireType}/drivers/hire', 'DriverController@hireDriver')->name('user.hire-driver');
    //   Route::get('cart/{id}/add', 'DriverController@addToCart')->name('user.cart.add');
    //   Route::get('cart/{id}/remove', 'DriverController@removeFromCart')->name('user.cart.remove');
    //   Route::get('dashboard/{hireType}/cart', 'DriverController@viewCart')->name('user.cart');

    //all Payments
    // Route::post('/pay', ['uses' => 'PaymentController@redirectToGateway','as' => 'pay']);

    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');



    //hire driver
    Route::get('dashboard/hire/select-type',  [DriverController::class, 'selectHireType'])->name('user.hire-type');
    Route::get('dashboard/{hireType}/drivers', [DriverController::class, 'list'])->name('user.drivers');
    Route::get('dashboard/{hireType}/drivers/hire', [DriverController::class, 'hireDriver'])->name('user.hire-driver');
    Route::post('dashboard/drivers/hire', [DriverController::class, 'hireDriverPayment'])->name('user.hire-driver-payment');
    Route::get('dashboard/{hireType}/drivers/{id}', 'DriverController@showDriver')->name('user.driver');
    Route::get('cart/{id}/add', 'DriverController@addToCart')->name('user.cart.add');
    Route::get('cart/{id}/remove', 'DriverController@removeFromCart')->name('user.cart.remove');
    Route::get('dashboard/{hireType}/cart', [DriverController::class, 'viewCart'])->name('user.cart');

    Route::get('dashboard/driver/complete-registration', 'Driver\RegistrationController@completeRegistration')->name('driver.complete-registration');
    Route::post('driver/driver/register/complete', 'Driver\RegistrationController@submitRegistration')->name('driver.register.compete');
    Route::post('driver/driver/register/resubmit', 'Driver\RegistrationController@resubmitRegistration')->name('driver.register.resubmit');

    Route::get('dashboard/online-driving',  [OnlineDriving::class,'index'])->name('online-driving');
    Route::post('dashboard/online-driving-payment/{id}',[OnlineDriving::class,'coursePayment'])->name('online-driving-payment');
    Route::get('dashboard/course/{course_id}', [OnlineDrivingController::class,'course'])->name('course');
    Route::get('dashboard/course/{id}/video/{videoId}',  [OnlineDrivingController::class,'courseVideo'])->name('course.video');

    // Route::get('dashboard/course/{id}/test/{testId}', 'OnlineDrivingController@courseTest')->name('course.test');

    //Quize here
    Route::get('dashboard/course/{course_id}/{quiz_id}', [quizController::class,'index'])->name('startQuiz');
    Route::post('savequizresult', [quizController::class,'savequizresult']);
//    Route::get('dashboard/course/{course_id}/{quiz_id}', 'quizController@index')->name('startQuiz');




    // Admin dashboard feed
    Route::get('admin/dashboard/feed', 'FeedController@index')->name('feed');
    Route::get('admin/dashboard/all-users', 'AllUsersController@index')->name('all.users');
    Route::get('admin/dashboard/action', 'AllUsersController@action')->name('usersAction');

    // Vehicle Request

    // Vehicle Request
    Route::get('admin/dashboard/vehicle/{id}', 'AdminHireVehicleController@hireVehicleRequest')->name('admin.vehicle-hire');
    Route::post('admin/dashboard/vehicle/{id}/reject', 'AdminHireVehicleController@rejectApproval')->name('admin.vehicle.reject');
    Route::get('admin/dashboard/vehicle/{id}/approve', 'AdminHireVehicleController@approveVehicle')->name('admin.vehicle.approve');
    Route::get('admin/dashboard/vehicle/{id}/revoke', 'AdminHireVehicleController@revokeApproval')->name('admin.vehicle.revoke');

    // Driver Request
    Route::get('admin/dashboard/drivers/{id}', 'Admin\DriverController@view')->name('admin.driver');
    Route::get('admin/dashboard/drivers/{id}/approve', 'Admin\DriverController@approveDriver')->name('admin.driver.approve');
    Route::post('admin/dashboard/drivers/{id}/reject', 'Admin\DriverController@rejectApproval')->name('admin.driver.reject');
    Route::get('admin/dashboard/drivers/{id}/revoke', 'Admin\DriverController@revokeApproval')->name('admin.driver.revoke');

    Route::get('admin/dashboard/corporate/{id}', 'Admin\CorporateController@view')->name('admin.corporate');
    Route::get('admin/dashboard/corporate/{id}/approve', 'Admin\CorporateController@approve')->name('admin.corporate.approve');
    Route::get('admin/dashboard/corporate/{id}/reject', 'Admin\CorporateController@rejectApproval')->name('admin.corporate.reject');
    Route::get('admin/dashboard/corporate/{id}/revoke', 'Admin\CorporateController@revokeApproval')->name('admin.corporate.revoke');

    Route::get('admin/dashboard/hire-request/{id}', 'Admin\DriverHireController@hireRequest')->name('admin.hire-request');
    Route::get('admin/dashboard/hire-request/{id}/{driverId}/approve', 'Admin\DriverHireController@approveRequest')->name('admin.hire-request.approve');
    Route::get('admin/dashboard/hire-request/{id}/{driverId}/decline', 'Admin\DriverHireController@declineRequest')->name('admin.hire-request.decline');
    Route::get('admin/dashboard/hire-request/{id}/{driverId}/terminate', 'Admin\DriverHireController@terminateEmployment')->name('admin.hire-request.terminate');
});
