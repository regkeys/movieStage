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




/**
 *  Route for HomePage
 *
 */
Route::get('/', function () {
    return view('welcome');
});


/**
 *  Route for login system - authorized
 *
 */
Auth::routes();


/**
 *  DASHBOARD - explicitly lay out the route to the controller now and then define the class
 *
 */
Route::get('/DASHBOARD', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');


/**
 *  User-profile page route - page that contains user listing
 *
 */
Route::get('/user-profile', [\App\Http\Controllers\DashboardController::class, 'userprofile'])->name('user-profile');


/**
*  Route to UPLOAD Controller - numerous classes
*  php artisan make:controller NameOfController -r
*
*/
Route::resource('upload', '\App\Http\Controllers\UploadsController');


/**
 *  (2) Route to Manage User Controller - resource that makes an directory below - note double \\ and makes model
 *  php artisan make:controller \\Admin\\UserController -r mUser
 *  elimated a few pages in controller so we used - ['except' => ['show', 'create', 'store']]
 * Now Using middleware with the CAN: - will apply the GATE that you designate first to the views
 *
 */
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function()
    {
    Route::resource('/users', '\App\Http\Controllers\Admin\UserController', ['except' => ['show', 'create', 'store']]);
    });

