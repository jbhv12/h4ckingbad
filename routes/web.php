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
Route::get('/start',function(){
  $id = Auth::id();
  $res = DB::table('userStats')->where('id', $id)->get();
  if(!count($res)){
    //start timer
    //make entry
    DB::table('userStats')->insert(
      ['id' => $id, 'name' => 'leader', 'member_name' => 'member2']
    );
    //redirect to problems
    return redirect('/problems');
  }else {
    echo "ur timer already started bru";
    return redirect('/problems');
  }


});
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
    echo "Please Log In First. Redirecting in 3 sec...";
    echo "<script>setTimeout(\"location.href = '/login';\",3000);</script>";
    return;
  }
  //TODO: proper error handling here
  $problems = DB::table('problems')->find($id);
  return View::make('problempage', compact('problems'));
});

Route::get('/home', 'HomeController@index');
