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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth\Admin')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.submit');
        Route::get('/register', 'LoginController@showRegistrationForm')->name('register');
        Route::post('/register', 'LoginController@register')->name('register.submit');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        // Password reset routes

        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });
    Route::get('/', 'AdminController@index')->name('admin')->middleware('auth:admin');

    Route::middleware('auth:admin')->namespace('Admin')->group(function () {
        Route::resource('users', 'UserController');
    });
});
