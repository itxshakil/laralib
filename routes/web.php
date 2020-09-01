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
Route::post('/ratings/{book}', 'RatingController@store')->name('rating.store')->middleware('auth');

Route::get('/search', 'SearchController@show')->name('search');

Route::post('/contact', 'ContactController')->name('contact');

Route::get('request-book', 'RequestedBookController@create')->name('request.books');
Route::post('request-book', 'RequestedBookController@store')->name('request.books.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth\Admin')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.submit');
        Route::get('/register', 'LoginController@showRegistrationForm')->name('register');
        Route::post('/register', 'LoginController@register')->name('register.submit');
        Route::post('/logout', 'LoginController@logout')->name('logout');

        Route::get('/password/change', 'ChangePasswordController@showForm');
        Route::post('/password/change', 'ChangePasswordController@change')->name('password.change');


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
        Route::put('/issues/{issueLog}', 'IssueLogController@markAsReturn')->name('issue_logs.return');

        Route::delete('/ratings/{rating}', 'RatingController@destroy')->name('ratings.destroy');

        Route::post('/tags', 'TagController@store')->name('tags.store');


        Route::get('request-book', 'RequestedBookController@index')->name('request.books');
        Route::get('request-book/{requestedBook}', 'RequestedBookController@show')->name('request.books.show');
        Route::post('request-book/{requestedBook}/approve', 'RequestedBookController@approve')->name('request.books.approve');
        Route::post('request-book/{requestedBook}/reject', 'RequestedBookController@reject')->name('request.books.reject');
        Route::post('request-book', 'RequestedBookController@store')->name('request.books.store');
    });
});

Route::middleware('auth:admin')->prefix('api')->namespace('Api')->group(function () {
    Route::get('/admin/books', 'Admin\BookController@index');
    Route::get('/admin/users', 'Admin\UserController@index');
    Route::get('/admin/authors', 'Admin\AuthorController@index');
    Route::get('/admin/issues', 'Admin\IssueController@index');

    Route::get('/book/isbn/{book:isbn}', 'Admin\BookController@bookByISBN');
    Route::get('/course/{course:id}/user/{user:rollno}', 'Admin\UserController@rollno');
    Route::post('/admin/issues', 'Admin\IssueController@store');
});
