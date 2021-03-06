<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Category;
use App\Round;
use App\Problem;
use App\User;
use App\UserProfile;

use Carbon\Carbon;

use DB;

class RoundController extends Controller
{
    /**
     * Instantiate a new RoundController instance.
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
        $rounds = Round::all();
        return view('round.index')->with('rounds', $rounds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('round.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:64|unique:rounds,name',
            'hours' => 'required|numeric|min:0|max:3',
            'minutes' => 'required|numeric|min:0|max:60',
            'seconds' => 'required|numeric|min:0|max:60',
        ]);

        $round = new Round;
        $round->name = $request->name;
        $time = ($request->hours * 3600) + ($request->minutes * 60) + $request->seconds;
        $round->maxtime = $time;
        $round->save();

        $request->session()->flash('flashSuccess', 'New Round Created Successfully');

        return redirect()->route('round.index');
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
        $round = Round::findOrFail($id);
        $h = $round->getHours();
        $m = $round->getMinutes();
        $s = $round->getSeconds();
        return view('round.edit')->with('round', $round)->with('h',$h)->with('m',$m)->with('s',$s);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $round = Round::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:64|unique:rounds,name,'. $round->id .',id',
            'hours' => 'required|numeric|min:0|max:3',
            'minutes' => 'required|numeric|min:0|max:60',
            'seconds' => 'required|numeric|min:0|max:60',
        ]);

        $round->name = $request->name;
        $time = ($request->hours * 3600) + ($request->minutes * 60) + $request->seconds;
        $round->maxtime = $time;
        $round->save();

        $request->session()->flash('flashSuccess', 'Round Details Updated Successfully');

        return redirect()->route('round.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
    }

    /**
     * Display categories under this Round.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id)
    {
        $round = Round::findOrFail($id);
        $categories = $round->Categories;
        
        return view('round.showcategory')->with('round', $round)->with('categories', $categories);
    }

    /**
     * Create categories under this Round.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createCategory($id)
    {
        $round = Round::findOrFail($id);
        $categories = Category::all();
        
        return view('round.createcategory')->with('round', $round)->with('categories', $categories);
    }

    /**
     * Add new category in this round.
     *
     * @param  int  $accessgroup
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request, $id)
    {   
        $this->validate($request, [
            'category' => 'required|numeric|exists:categories,id',
            'total_problems' => 'required|numeric|min:1',
        ]);

        $round = Round::findOrFail($id);
        $category = Category::where('id',$request->category)->first();

        if($category->Rounds->contains($round)){
            $request->session()->flash('flashWarning', 'Category is already in this round');
        }
        else{
            $category->Rounds()->attach($round, ['total_problems' => $request->total_problems]);
            $request->session()->flash('flashSuccess', 'Category Added to this Round');
        }

        return redirect()->route('round.showcategory', $round->id);
    }

    /**
     * Display categories under this Round.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $round = Round::findOrFail($id);
        $users = $round->Users;
        
        return view('round.showuser')->with('round', $round)->with('users', $users);
    }

    /**
     * Create categories under this Round.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createUser($id)
    {
        $round = Round::findOrFail($id);
        //change it to show minimal users later-on
        $users = User::orderBy('created_at','desc')->get();
        
        return view('round.createuser')->with('round', $round)->with('users', $users);
    }

    /**
     * Add new category in this round.
     *
     * @param  int  $accessgroup
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request, $id)
    {   
        $this->validate($request, [
            'user' => 'required|numeric|exists:users,id',
        ]);

        $round = Round::findOrFail($id);
        $user = User::where('id',$request->user)->first();

        if($user->Rounds->contains($round)){
            $request->session()->flash('flashWarning', 'User is already in this round');
        }
        else{
            DB::beginTransaction();
            try{
                $user->Rounds()->attach($round, [
                    'hasstarted' => false,
                    'starttime' => Carbon::now(),
                    'endtime' => Carbon::now()->addSeconds(1)
                ]);
                $users_in_rounds =  DB::table('users_in_rounds')->select('id')->where('user_id',$user->id)->where('round_id',$round->id)->first();
                $categories = $round->Categories;
                foreach ($categories as $category) {
                    $userProblems = DB::table('problems_by_users')->select('problem_id')->where('user_id',$user->id)->get()->pluck('problem_id');
                    $problems = Problem::where('category_id',$category->id)->whereNotIn('id', $userProblems->all())->inRandomOrder()->limit($category->pivot->total_problems)->get();
                    foreach ($problems as $problem) {
                        $user->Problems()->attach($problem, [
                                'users_in_rounds_id' => $users_in_rounds->id,
                                'hastried' => false,
                                'hastakenminorhint' => false,
                                'hastakenmajorhint' => false,
                                'time' => 0,
                                'points' => 0,
                            ]);
                    }
                }
                $request->session()->flash('flashSuccess', 'User Added to this Round');
                DB::commit();
            }
             catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('flashDanger', 'Something went wrong on server side!');
            }
        }

        return redirect()->route('round.showuser', $round->id);
    }
}
