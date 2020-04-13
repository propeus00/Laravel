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

Route::middleware(["auth"])->group(function () {


    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/categories', 'CategoriesController@store')->name('categories.store');


    Route::resource('posts', 'PostsController');
});

Route::get('/', "WelcomeController@index")->name("welcome.index");
Route::resource('categories', 'CategoriesController');
Auth::routes();

Route::middleware(["auth", "checkIsAdmin"])->group(function () {
    Route::put('restore-posts/{post}', "PostsController@restore")->name("restore-posts");
    Route::get('trashed', "PostsController@trashed")->name("trashed-posts");
    Route::get("users", "UsersController@index")->name("users.index");
    Route::post("users/make-admin/{user}", "UsersController@makeAdmin")->name("users.make-admin");
    Route::post("users/remove-admin/{user}", "UsersController@removeAdmin")->name("users.remove-admin");
});
