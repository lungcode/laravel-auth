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

Route::get('','HomeController@index')->name('home.index');

Route::get('admin/login','AdminController@login')->name('admin.login');
Route::get('admin/logout','AdminController@logout')->name('admin.logout');

Route::post('admin/login','AdminController@post_login')->name('admin.login');
Route::get('admin/error','AdminController@error')->name('admin.error');

Route::group(['prefix' => 'admin', 'middleware' => 'auth','as' => 'admin.'],function () {
	Route::get('','AdminController@index')->name('index');
	Route::resources([
		'category' => 'CategoryController',
		'post' => 'PostController',
		'user' => 'UserController',
		'role' => 'RoleController',
	]);
});