<?php

use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
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

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@index')->name('admin')->middleware('admin');
        Route::get('/road', 'RoadController@index')->name('road')->middleware('admin');
        Route::get('/toll', 'TollController@index')->name('admin/toll')->middleware('admin');
        Route::get('/bookinglist', 'TollBookingController@index')->name('admin/bookinglist')->middleware('admin');
        Route::get('/userlist', 'UserController@userList')->name('userlist')->middleware('admin');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('user')->middleware('tolluser');
        Route::get('/tollbooking', 'TollBookingController@index')->name('tollbooking')->middleware('tolluser');
        Route::get('/vehicle', 'VehicleController@index')->name('vehicle')->middleware('tolluser');
    });
});


