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
	// Routes only for admins
	Route::middleware(['admin'])->group(function() {
		// Roles routes
		Route::get('/roles', 'RolesController@index')->name('roles.index');
		Route::get('/roles/{role}', 'RolesController@show')->name('roles.show');
		// Users routes
		Route::put('/roles/change_user_role', 'UsersController@change_user_role')->name('change_user_role'); // Method, which change user role
		Route::get('/users', 'UsersController@index')->name('users.list');  // The list of all users in the app (visible only for admins)
		Route::put('/users/require_change_password/', 'UsersController@require_change_password')->name('require_change_password');

		//Route Genres Controller
		Route::resource('/genres', 'GenresController')->except('index', 'show');

		//Route Nationalities Controller
		Route::resource('/nationalities', 'NationalitiesController')->except('index', 'show');
	});

	// Route for user speed
	Route::get('/user_speed', 'BooksController@user_speed')->name('user_speed');

	// Route for read book up to page save in db
	Route::put('/save_up_to_page/{book}', "BooksController@save_up_to_page")->name('save_up_to_page');

	// Route group for everyone except plain users
	Route::middleware(['not_plain_user'])->group(function () {
		Route::resource('books', 'BooksController')->except('index', 'show');
	});
	//  User routes which require only login
	Route::get('users/change_user_image/', 'UsersController@change_user_image')->name('change_user_image');
	Route::patch('users/change_user_image/', 'UsersController@change_user_image_action')->name('change_user_image_action');


	// Books routes
	Route::resource('books', 'BooksController')->only('index', 'show');

	Route::post('/book/{book}/start_reading', 'BooksController@start_reading')->name('start_reading');
	Route::get('/book/readlist', 'BooksController@readlist')->name('readlist');
	Route::get('/book/{book}/read_book', 'BooksController@read_book')->name('read_book');
	Route::post('/book/{book}/delete_from_readlist', 'BooksController@delete_book_from_readlist')->name('delete_from_readlist');

	// Wishlist routes
	Route::resource('wishlists', 'WishlistController')->except('create', 'edit', 'update', 'show');

	//Route Genres Controller
	Route::resource('genres', 'GenresController')->only('index', 'show');

	//Route Nationalities Controller
	Route::resource('nationalities', 'NationalitiesController')->only('index', 'show');

	//Route Authors Controller
	Route::resource('/authors', 'AuthorsController');

	// Notifications routes
	Route::resource('/notifications', 'NotificationsController')->only('index');
	Route::get('/user_dashboard', 'NotificationsController@index')->name('user_dashboard');
	Route::get('/notification_seen/{id}', 'NotificationsController@notification_seen')->name('notification_seen');
	Route::get('/mark_all_notifications_as_seen', 'NotificationsController@mark_all_notifications_as_seen')->name('mark_all_notifications_as_seen');

});
