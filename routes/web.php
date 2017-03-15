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
    return 'welcome';
});
Auth::routes();

Route::get('/problems',function(){
  $problems = DB::table('problems')->get();     //add condition. return problems appropriate to round.
  return View::make('problemlist', compact('problems'));
});

Route::get('/problems/{id}',function($id){
  $problems = DB::table('problems')->find($id);   
//  dd($problems);
  return View::make('problempage', compact('problems'));
});

Route::get('/home', 'HomeController@index');
