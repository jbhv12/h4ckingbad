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

Route::post('contact',
  ['as' => 'contact_store', 'uses' => 'ProblemController@store']);

Route::get('problems',
  ['as' => 'problems', 'uses' => 'ProblemController@showProblems']);
Route::get('problems/{id}',
  ['as' => 'problems', 'uses' => 'ProblemController@showProblemPage']);
Route::post('eval',
  ['as' => 'eval', 'uses' => 'ProblemController@evaluate']);

Route::get('/start',function(){
  $id = Auth::id();
  $res = DB::table('userStats')->where('id', $id)->get();
  if(!count($res)){
    DB::table('userStats')->insert(
      ['id' => $id,
       'name' => 'leader',
       'member_name' => 'member2',
       'problems_solved' => serialize(array()),
       'hints_taken' => serialize(array(array())),
       'score' => 0,
       'rank' => 0,
       'start_time' => time(),
       'cur_lvl' => 1]
    );
    return redirect('/problems');
  }else{

      //TODO: hardcodet this block

      // if(startime==0 and curtime>=round2time){
      //   //update db startime = CURRENT_TIMESTAMP
      //   //break
      // }

      $timelimitinsec = 10;     //TODO: fetch limit from rounds table.
      $st = DB::table('userStats')->where('id', $id)->value('start_time');
      $et = $st + $timelimitinsec;
      if($st==null){echo "ur time is over";}
      else if(time()>$et){
      echo "ur time is over";
      DB::table('userStats')->where('id', $id)->update(['start_time' => null]);
      }
    else{
      echo "ur timer already started bru";
      return redirect('/problems');
     }
    }
});

Route::get('/home', 'HomeController@index');
