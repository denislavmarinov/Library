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
Route::get('/', function () {
    return view('home');
})->name('homepage');

// Route for user authentication
Auth::routes();

Route::get('/users/password_update', 'UsersController@password_update')->name('password_update')->middleware('auth');
Route::put('/users/password_update/store', 'UsersController@store_new_password')->name('password_update_store')->middleware('auth');

Route::middleware(['auth', 'required_password_change'])->group(function() {
	// Roles routes
	Route::get('/roles', 'RolesController@index')->name('roles.index'); // Page where all roles are listed
	Route::get('/roles/{role}', 'RolesController@show')->name('roles.show'); // Page where the users. which has selected role are listed

	// Users routes
	Route::put('/roles/change_user_role', 'UsersController@change_user_role')->name('change_user_role'); // Method, which change user role
	Route::get('/users', 'UsersController@index')->name('users.list');  // The list of all users in the app (visible only for admins)
	Route::put('/users/require_change_password/', 'UsersController@require_change_password')->name('require_change_password');
	Route::get('users/change_user_image/', 'UsersController@change_user_image')->name('change_user_image');
	Route::patch('users/change_user_image/', 'UsersController@change_user_image_action')->name('change_user_image_action');

	// Books routes
	Route::resource('books', 'BooksController');
	Route::post('/book/{book}/start_reading', 'BooksController@start_reading')->name('start_reading');
	Route::get('/book/readlist', 'BooksController@readlist')->name('readlist');
	Route::get('/book/{book}/read_book', 'BooksController@read_book')->name('read_book');
	Route::post('/book/{book}/delete_from_readlist', 'BooksController@delete_book_from_readlist')->name('delete_from_readlist');

	// Wishlist routes
	Route::resource('/wishlist', 'WishlistController');

	//Route Genres Controller
	Route::resource('/genres', 'GenresController');

	//Route Nationalities Controller
	Route::resource('/nationalities', 'NationalitiesController');

	//Route Authors Controller
	Route::resource('/authors', 'AuthorsController');
	
	// Notifications routes
	Route::resource('/notifications', 'NotificationsController');
	Route::get('/user_dashboard', 'NotificationsController@index')->name('user_dashboard');
	Route::get('/notification_seen/{id}', 'NotificationsController@notification_seen')->name('notification_seen');
	Route::get('/mark_all_notifications_as_seen', 'NotificationsController@mark_all_notifications_as_seen')->name('mark_all_notifications_as_seen');

});
