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

//TODO: create controller files for all routes

Route::get('/problems',function(){
  if (Auth::guest())
  {
     return redirect('/login');
  //  return "Bummer! You need to log in, dude.";
  }
  $problems = DB::table('problems')->get();     //add condition. return problems appropriate to round.
  return View::make('problemlist', compact('problems'));
});

Route::get('/problems/{id}',function($id){
  if (Auth::guest())
  {
    // TO LEARN: print error. wait 3 sec. then redirect.
    return "Bummer! You need to log in, dude.";
  }
  //TODO: proper error handling here
  $problems = DB::table('problems')->find($id);
  return View::make('problempage', compact('problems'));
});

Route::get('/home', 'HomeController@index');
