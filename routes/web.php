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
Route::get('/books', 'BookController@index')->name('books.index');
Route::get('/books/{book}', 'BookController@show')->name('books.show');
Route::get('/authors/{author}', 'AuthorController@show')->name('authors.show');
Route::get('/issues', 'IssueController@index')->name('issues.index')->middleware('auth');

Route::post('/ratings/{book}', 'RatingController@store')->name('rating.store');

Route::get('/search', 'SearchController@show')->name('search');

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
    Route::get('/', 'AdminController@index')->name('dashboard')->middleware('auth:admin');

    Route::middleware('auth:admin')->namespace('Admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('books', 'BookController');
        Route::resource('authors', 'AuthorController');

        Route::get('/issues', 'IssueLogController@index')->name('issue_logs.index');
        Route::get('/issues/create', 'IssueLogController@create')->name('issue_logs.create');
        Route::post('/issues', 'IssueLogController@store')->name('issue_logs.store');

        Route::post('/tags', 'TagController@store')->name('tags.store');
    });
});

Route::prefix('api')->namespace('Api')->group(function () {
    Route::get('/admin/books', 'Admin\BookController@index')->middleware('auth:admin');
    Route::get('/admin/users', 'Admin\UserController@index')->middleware('auth:admin');
    Route::get('/admin/authors', 'Admin\AuthorController@index')->middleware('auth:admin');
    Route::get('/admin/issues', 'Admin\IssueController@index')->middleware('auth:admin');

    Route::get('/book/isbn/{book:isbn}', 'Admin\BookController@isbn')->middleware('auth:admin');
    Route::get('/course/{course:id}/user/{user:rollno}', 'Admin\UserController@rollno')->middleware('auth:admin');
    Route::post('/admin/issues', 'Admin\IssueController@store');
});
