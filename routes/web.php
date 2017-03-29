<?php

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

Route::get('/home', 'HomeController@index');
Route::resource('team', 'UserProfileController');
Route::resource('accessgroup', 'AccessGroupController');
Route::delete('accessgroup/{accessgroup}/user/{user}/remove', 'AccessGroupController@destroyUserAccessGroup')->name('accessgroup.destroyuser');
Route::get('accessgroup/{accessgroup}/user/create', 'AccessGroupController@createUserAccessGroup')->name('accessgroup.createuser');
Route::post('accessgroup/{accessgroup}/user/store', 'AccessGroupController@storeUserAccessGroup')->name('accessgroup.storeuser');

Route::resource('category','CategoryController');
Route::resource('round','RoundController');
Route::get('round/{round}/category','RoundController@showCategory')->name('round.showcategory');
Route::get('round/{round}/category/create','RoundController@createCategory')->name('round.createcategory');
Route::post('round/{round}/category/store','RoundController@storeCategory')->name('round.storecategory');

Route::resource('problem','ProblemController');