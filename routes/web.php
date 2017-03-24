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

//Route::get('/', function () {
//    return 'welcome';
//});
Auth::routes();

//TODO: create controller files for all routes



Route::get('categories',
  ['as' => 'problems', 'uses' => 'ProblemController@showCategories']);
Route::get('categories/{id}',
  ['as' => 'problems', 'uses' => 'ProblemController@showCategoriesPage']);
Route::get('problems/{id}',
  ['as' => 'problems', 'uses' => 'ProblemController@showProblemPage']);
Route::get('problems/{pid}/h{hid}',
  ['as' => 'problems', 'uses' => 'ProblemController@showHint']);
Route::post('problems/{id}',
  ['as' => 'eval', 'uses' => 'ProblemController@evaluate']);

Route::get('/c{cid}/problems',
  ['as' => 'problems', 'uses' => 'ProblemController@showProblems']);


Route::get('/c{cid}/start',function($cid){
  $id = Auth::id();
  if($cid==0){
	 $userStats = App\UserStats::find($id);
	 $userStats->cc = 0;
	 $userStats->save();
	 return;
  }
  $contest = App\Contest::find($cid);
  if(time()>$contest->start_time and time()<$contest->end_time){
	  $userStats = App\UserStats::find($id);
	  if($userStats->cc != $cid){
		$userStats->st = time();
		$userStats->cc = $cid;
		$userStats->save();
	  }else{
		  echo "already started";
	  }
  }else{
	  echo "vah h hju orrr pati gyu h";
  }
});

Route::get('/', 'HomeController@index');

Route::get('/about', function(){
	echo "static page here";
});
Route::get('/instructions' ,function(){
	echo "one more statc page";
});
function idtoemail($a){
	$user = \App\User::find($a->id);
	return $user->email;
}
Route::get('/scoreboard', function(){
	$all = DB::table('userStats')->where('rank','!=',0)->orderBy('rank', 'asc')->get();
	$email = array();
	foreach($all as $a){
		array_push($email,idtoemail($a));
	}
	return View('scoreboard')->with('all',$all)->with('email',$email);
	echo $all[0]->id;
	echo count($all);
});

//ht=[[pid,hid]..]
//ha=[[cost,txt],..]
