<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use DB;
use View;



class ProblemController extends Controller
{
  // public function create()
  // {
  //     return view('contact');
  // }
  public function showProblems(){
    if (Auth::guest())
    {
       return redirect('/login');
    //  return "Bummer! You need to log in, dude.";
    }
    $problems = DB::table('problems')->get();     //add condition. return problems appropriate to round.
    return View::make('problemlist', compact('problems'));
  }
  public function showCategories()
  {
    if (Auth::guest())
    {
       return redirect('/login');
    //  return "Bummer! You need to log in, dude.";
    }
    $categories = DB::table('categories')->get();
    return View::make('categorieslist', compact('categories'));
  }
  public function showCategoriesPage($id){
    $problems = DB::table('problems')->where('categoryid', $id)->get();
    return View::make('problemlist', compact('problems'));
  }
  public function showProblemPage($id)
  {
    if (Auth::guest())
    {
      echo "Please Log In First. Redirecting in 3 sec...";
      echo "<script>setTimeout(\"location.href = '/login';\",3000);</script>";
      return;
    }
    //TODO: proper error handling here
    $problems = DB::table('problems')->find($id);
    return View::make('problempage', compact('problems'));
  }
  public function evaluate(Request $req)
  {
    $enterdFlag = $req->input('flag');
    $probId = $req->input('pid');
    $userId = Auth::id();
    //if user already solved prob
    $userSolvedProblemArray = unserialize(DB::table('userStats')->where('id', $userId)->value('problems_solved'));
    if( in_array( $probId ,$userSolvedProblemArray ) )
    {
      echo "thai gyu h.";
    }else{
      $correctFlag = DB::table('problems')->where('id', $probId)->value('flag');
      if($enterdFlag == $correctFlag){
        array_push($userSolvedProblemArray, $probId);

        //check if any hints taken
        $hintcost = 0;
        $hintsTakenArray = unserialize(DB::table('userStats')->where('id', $userId)->value('hints_taken'));
        //error :(
        //optimization:remove entry
        foreach ($hintsTakenArray as $item) {
          if($item[0]==$probId) {
            $hintcost = $item[1];
          }
        }

        $currentScore = DB::table('userStats')->where('id', $userId)->value('score');
        $problemPoints = DB::table('problems')->where('id', $probId)->value('points');

        DB::table('userStats')->where('id', $userId)->update(['problems_solved' => serialize($userSolvedProblemArray)]);
        DB::table('userStats')->where('id', $userId)->update(['score' => $currentScore + $problemPoints - $hintcost]);
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

  public function store(Request $request)
  {
    $name = $request->input('name');
    echo $name;
  }
}
