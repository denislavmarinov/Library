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


// Roles routes
Route::get('/roles', 'RolesController@index')->name('roles.index'); // Page where all roles are listed
Route::get('/roles/{role}', 'RolesController@show')->name('roles.show'); // Page where the users. which has selected role are listed

// Users routes
Route::put('/roles/change_user_role', 'UsersController@change_user_role')->name('change_user_role'); // Method, which change user role
