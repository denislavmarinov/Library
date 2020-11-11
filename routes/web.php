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

// Homepage route
Route::get('/home', function () {
    return view('home');
})->name('homepage');


// Roles routes
Route::get('/roles', 'RolesController@index')->name('roles.index'); // Page where all roles are listed
Route::get('/roles/{role}', 'RolesController@show')->name('roles.show'); // Page where the users. which has selected role are listed

// Users routes
Route::put('/roles/change_user_role', 'UsersController@change_user_role')->name('change_user_role'); // Method, which change user role
Route::get('/users', 'UsersController@index')->name('users.list');  // The list of all users in the app (visible only for admins)
Route::put('/users/require_change_password', 'UsersController@require_change_password')->name('require_change_password');// Wrong route!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
Route::get('/user_dashboard', function(){
	return view('user_dashboard.user_dashboard');
})->name('user_dashboard');

// Books routes
Route::resource('books', 'BooksController');
Route::post('/book/{book}/start_reading', 'BooksController@start_reading')->name('start_reading');
Route::get('/book/readlist', 'BooksController@readlist')->name('readlist');
Route::get('/book/{book}/read_book', 'BooksController@read_book')->name('read_book');
Route::post('/book/{book}/delete_from_readlist', 'BooksController@delete_book_from_readlist')->name('delete_from_readlist');

// Wishlist routes
Route::resource('wishlist', 'WishlistController');

// Route for user authentication
Auth::routes();

//Route Genres Controller
Route::resource('genres', 'GenresController');

//Route Nationalities Controller
Route::resource('nationalities', 'NationalitiesController');