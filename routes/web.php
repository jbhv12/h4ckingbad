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
	return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/rules', 'HomeController@rules')->name('rules');
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

Route::get('round/{round}/user','RoundController@showUser')->name('round.showuser');
Route::get('round/{round}/user/create','RoundController@createUser')->name('round.createuser');
Route::post('round/{round}/user/store','RoundController@storeUser')->name('round.storeuser');

Route::resource('user','UserController');
Route::get('user/{user}/round','UserController@indexParticipantRound')->name('user.indexparticipantround');
Route::post('user/{user}/round/{round}/start','UserController@startParticipantRound')->name('user.startparticipantround');
Route::get('user/{user}/round/{round}/stop','UserController@stopParticipantRound')->name('user.stopparticipantround');
Route::get('user/{user}/problem', 'UserController@indexParticipantProblem')->name('user.indexparticipantproblem');
Route::get('user/{user}/problem/{problem}', 'UserController@showParticipantProblem')->name('user.showparticipantproblem');
Route::post('user/{user}/problem/{problem}', 'UserController@solveParticipantProblem')->name('user.solveparticipantproblem');
Route::get('user/{user}/problem/{problem}/minor', 'UserController@takeMinorhint')->name('user.takeminorhint');
Route::get('user/{user}/problem/{problem}/major', 'UserController@takeMajorhint')->name('user.takemajorhint');