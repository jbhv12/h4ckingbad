<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

use App\Category;
use App\Problem;
use App\User;

use Purifier;
use App\Http\Requests\CUProblemRequest;

class ProblemController extends Controller
{
    /**
     * Instantiate a new ProblemController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', [
            "except" => ['']
          ]);
        $this->middleware('admin', [
            "except" => ['']
          ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems = Problem::with('category')->orderBy('updated_at','desc')->paginate(20);
        return view('problem.index')->with('problems',$problems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('problem.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CUProblemRequest $request)
    {
        //once Request is validated go further
        Purifier::clean($request->abstraction);
        $problem = Problem::create([
            "title" => $request->title,
            "category_id" => $request->category,
            "abstraction" => $request->abstraction,
            "minorhint" => $request->minorhint,
            "majorhint" => $request->majorhint,
            "flag" => $request->flag,
            "problempageurl" => $request->problempageurl,
            "problemfilespath" => $request->problemfilespath
        ]);

        Session::flash('flashSuccess', 'Problem created Succesfully...');

        //after storing post in database give response to user
        return redirect()->route('problem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        $request->session()->flash('flashInfo', 'For Now you can view data from Edit Problem Page');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $problem = Problem::with('category')->findOrFail($id);
        return view('problem.edit')->with('problem',$problem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CUProblemRequest $request, $id)
    {
        $problem = Problem::findOrFail($id);
        //once Request is validated go further
        Purifier::clean($request->abstraction);
        $problem->title = $request->title;
        $problem->abstraction = $request->abstraction;
        $problem->minorhint = $request->minorhint;
        $problem->majorhint = $request->majorhint;
        $problem->flag = $request->flag;
        $problem->problempageurl = $request->problempageurl;
        $problem->problemfilespath = $request->problemfilespath;
        $problem->save();

        Session::flash('flashSuccess', 'Problem Updated Succesfully...');

        //after storing post in database give response to user
        return redirect()->route('problem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
    }

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
			return View::make('problempage', compact(['problems']));
		}else{
			echo "this prob doesnt blong to u";
		}
	}

	public static function showHint($pid,$hid){
		$uid = Auth::id();
		$userStats =  \App\UserStats::find($uid);
		$hintstaken = unserialize($userStats->hints_taken);
		$flag=-1;
		//check if hint already taken
		for($j=0; $j<count($hintstaken); $j++){
			if($hintstaken[$j][0] == $pid){
				$flag = $j;
				for($i=1; $i<count($hintstaken[$j]); $i++){
					if($hid == $hintstaken[$j][$i]){
						$prob = DB::table('problems')->find($pid);
						$allhints = unserialize($prob->hintArray);
						return $allhints[$hid][1];
					}
				}
			}
		}
		//if not..
		if($flag==-1){
			array_push($hintstaken,array($pid,$hid));
			DB::table('userStats')->where('id', $uid)->update(['hints_taken' => serialize($hintstaken)]);

		}else{
			array_push($hintstaken[$flag],$hid);
			DB::table('userStats')->where('id', $uid)->update(['hints_taken' => serialize($hintstaken)]);
		}
		$prob = DB::table('problems')->find($pid);
		$allhints = unserialize($prob->hintArray);
		return $allhints[$hid][1];
	}
	public function evaluate(Request $req, $id)
	{
		$userId = Auth::id();

		$us = \App\UserStats::find($userId);
		$userStartTime = $us->st;
		$userCurrentContest = $us->cc;
		$contest = DB::table('contests')->where('id', $userCurrentContest)->first();
		$contestEndTime = $contest->end_time;
		$contestDuration = $contest->duration;


		if(time()>$contestEndTime or time()-$userStartTime > $contestDuration) {
			return "puru";
		}

		$enterdFlag = $req->input('flag');
		$probId = $req->input('pid');
		$probId = $id;
		//if user already solved prob
		$userSolvedProblemArray = unserialize(DB::table('userStats')->where('id', $userId)->value('problems_solved'));
		if( in_array( $probId ,$userSolvedProblemArray ) )
		{
			echo "thai gyu h.";
			return back();  //also print msg.. //Maybe use default $errors
		}else{
			$correctFlag = DB::table('problems')->where('id', $probId)->value('flag');
			if($enterdFlag == $correctFlag){
				array_push($userSolvedProblemArray, $probId);

				//check if any hints taken
				$hintcost = 0;
				$hintsTakenArray = unserialize(DB::table('userStats')->where('id', $userId)->value('hints_taken'));
				$ha = unserialize(DB::table('problems')->where('id', $probId)->value('hintArray'));

				$index=0;
				foreach ($hintsTakenArray as $item) {
					if(!empty($item)){
						if($item[0]==$probId) {
							for ($i = 1; $i < count($item); $i++) {
								$hintcost+=$ha[$item[$i]][0];
							}
							//unset($hintsTakenArray[$index]);
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
				$lowers = DB::table('userStats')->where('score', '<', $userScore)->where('score','>',$currentScore)->orderBy('score', 'desc')->get();
				//echo $userScore, $currentScore;
				//dd($lowers);

				if(count($lowers)>0){
 					$newRank = $lowers[0]->rank  ;
 					DB::table('userStats')->where('id', $userId)->update(['rank' => $newRank]);
 				}
 				foreach ($lowers as $lower) {
 					#echo $lower->id;
 					$rank = $lower->rank;
 					if($rank != 0){
 						DB::table('userStats')->where('id', $lower->id)->update(['rank' => $rank + 1]);
 					}
 				}
 				echo "shabash!";
 


				if(count($lowers)>0){
					$newRank = $lowers[0]->rank  ;
					DB::table('userStats')->where('id', $userId)->update(['rank' => $newRank]);
				}
 //				else if(count($lowers)==0){
 //
 //					DB::table('userStats')->where('id', $userId)->update(['rank' => 1]);
		//		}
				foreach ($lowers as $lower) {
					#echo $lower->id;
					$rank = $lower->rank;
					if($rank != 0){
						DB::table('userStats')->where('id', $lower->id)->update(['rank' => $rank + 1]);
					}
				}
				echo "shabash!";

			}else {
				echo "khotu h topaa";
			}
		}
	}

}
