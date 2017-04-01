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

//TODO: create controller files for all routes

/**

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
		  return redirect('/c'.$cid.'/problems');
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

*/

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
Route::get('user/{user}/leaderboard', 'UserController@showCurrentLeaderboard')->name('user.showcurrentleaderboard');
