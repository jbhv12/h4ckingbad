<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use View;



class ProblemController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function showProblems($cid){
		$problems = \App\Problem::where('contest_id',$cid)->get();	
		return View::make('problemlist', compact('problems'));
	}
	public function showCategories()
	{
		$categories = DB::table('categories')->get();
		return View::make('categorieslist', compact('categories'));
	}
	public function showCategoriesPage($id){
		$uid = Auth::id();
		$userStats = \App\UserStats::find($uid);
		$cid = $userStats->cc;
		$problemsArray = \App\Problem::where('contest_id',$cid)->get();	 //ADD: where : or problem is open
		//	dd($problemsArray);
		$problems = array();
		foreach ($problemsArray as $problem) {
			$catarry = unserialize($problem->categoryid);
			// echo gettype($id);
			foreach ($catarry as $i) {
				if($i==(int)$id){
					array_push($problems,$problem);
				}
			}
		}
		return View::make('problemlist', compact('problems'));
	}
	public function showProblemPage($id)
	{
		$uid = Auth::id();
		$userStats = \App\UserStats::find($uid);
		$cid = $userStats->cc;
		$problems = DB::table('problems')->find($id);
		if($problems->contest_id == $cid){  			//or problem is open
			return View::make('problempage', compact('problems'));
		}else{
			echo "this prob doesnt blong to u";
		}
	}
	//  public function updateRank($userId)
	//  {
	//    $userScore = DB::table('userStats')->where('id', $userId)->value('score');
	//    $lowers = DB::table('userStats')->where('score', '<', $userScore)->orderBy('score', 'desc')->get();
	//
	//    $newRank = $lowers[0]->rank + 1;
	//
	//    foreach ($lowers as $lower) {
	//      $rank = $lower->rank;
	//      if($rank != 0){
	//        DB::table('userStats')->where('id', $lower->id)->update(['rank' => $rank + 1]);
	//      }
	//    }
	//  }

	public function showHint($pid,$hid){
		//find n return hint
	}
	public function evaluate(Request $req, $id)
	{
		$enterdFlag = $req->input('flag');
		$probId = $req->input('pid');
		$probId = $id;
		$userId = Auth::id();
		//if user already solved prob
		$userSolvedProblemArray = unserialize(DB::table('userStats')->where('id', $userId)->value('problems_solved'));
		if( in_array( $probId ,$userSolvedProblemArray ) )
		{
			// echo "thai gyu h.";
			return back();  //also print msg.. //Maybe use default $errors
		}else{
			$correctFlag = DB::table('problems')->where('id', $probId)->value('flag');
			if($enterdFlag == $correctFlag){
				array_push($userSolvedProblemArray, $probId);

				//check if any hints taken
				$hintcost = 0;
				$hintsTakenArray = unserialize(DB::table('userStats')->where('id', $userId)->value('hints_taken'));

				$index=0;
				foreach ($hintsTakenArray as $item) {
					if(!empty($item)){
						if($item[0]==$probId) {
							for ($i = 1; $i < count($array); $i++) {
								$hintcost+=$item[i];
							}
							unset($hintsTakenArray[$index]);
						}
					}
					$index++;
				}

				//add points
				$currentScore = DB::table('userStats')->where('id', $userId)->value('score');
				$problemPoints = DB::table('problems')->where('id', $probId)->value('points');

				DB::table('userStats')->where('id', $userId)->update(['problems_solved' => serialize($userSolvedProblemArray)]);
				DB::table('userStats')->where('id', $userId)->update(['score' => $currentScore + $problemPoints - $hintcost]);

				//update rank
				$userScore = DB::table('userStats')->where('id', $userId)->value('score');
				$lowers = DB::table('userStats')->where('score', '<', $userScore)->orderBy('score', 'desc')->get();

				if(array_key_exists(0,$lowers)){
					$newRank = $lowers[0]->rank + 1;
					DB::table('userStats')->where('id', $userId)->update(['rank' => $newRank]);
				}
				foreach ($lowers as $lower) {
					echo $lower->id;
					$rank = $lower->rank;
					if($rank != 0){
						DB::table('userStats')->where('id', $lower->id)->update(['rank' => $rank + 1]);
					}
				}

			}else {
				echo "khotu h topaa";
			}
		}
		// echo $probId;
		// echo $enterdFlag;
		// foreach($userSolvedProblemArray as $value){
		// echo $value . "<br>";
		// }
	}

}
