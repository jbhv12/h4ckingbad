<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Category;
use App\Round;
use App\Problem;
use App\User;
use App\UserProfile;
use App\LeaderBoard;
use App\UserInRound;

use Carbon\Carbon;

use DB;
use Gate;

class UserController extends Controller
{
    /**
     * Instantiate a new RoundController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', [
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
        $users = User::orderBy('updated_at','desc')->paginate(25);
        return view('user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
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
    public function edit(Request $request,$id)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
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
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexParticipantRound(Request $request, $id)
    {
        if(Gate::denies('index-participantround', $id)){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        $user = User::with('Rounds')->findOrFail($id);
        return view('user.indexparticipantround')->with('user',$user);
    } 

    /**
     * Start the round for this user.
     *
     * @return \Illuminate\Http\Response
     */
    public function startParticipantRound(Request $request,$user,$round)
    {
        $user = User::findOrFail($user);
        $round = Round::findOrFail($round);

        if(Gate::denies('participantround', [$user, $round] )){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }

        $userround = UserInRound::where('user_id',$user->id)->where('round_id',$round->id)->first();
        if($userround->hasstarted == 1 || $userround->hasstarted == true){
            $request->session()->flash('flashWarning', 'You have already started this round');
            return back();       
        }
        $userround->hasstarted = true;
        $userround->starttime = Carbon::now();
        $userround->endtime = Carbon::now()->addSeconds($round->maxtime);
        $userround->save();

        $leaderboard = new LeaderBoard;
        $leaderboard->user_in_round_id = $userround->id;
        $leaderboard->time = 0;
        $leaderboard->points = 0;
        $leaderboard->position = 0;
        $leaderboard->save();

        $request->session()->put('round', $round);
        $request->session()->put('user_in_round', $userround);
        $request->session()->put('leaderboard', $leaderboard);
        $request->session()->put('starttime', $userround->starttime);
        $request->session()->put('endtime', $userround->starttime);

        return redirect()->route('user.indexparticipantproblem', $user->id);
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexParticipantProblem(Request $request, $id)
    {
        if(Gate::denies('index-participantproblem', $id)){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        $user = User::findOrFail($id);
        $problems = $user->Problems()->wherePivot('users_in_rounds_id', session()->get('user_in_round')->id)->get();
        
        return view('user.indexparticipantproblem')->with('user',$user)->with('problems',$problems);
    }

    /**
     * Display a the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showParticipantProblem(Request $request, $id, $problem)
    {
        $user = User::findOrFail($id);
        $problem = $user->Problems()->wherePivot('problem_id',$problem)->first();
        if(Gate::denies('show-participantproblem', [ $user, $problem ] )){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        
        return view('user.showparticipantproblem')->with('user',$user)->with('problem',$problem);
    }

    /**
     * Display a the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function takeMinorhint(Request $request, $id, $problemId)
    {
        $user = User::findOrFail($id);
        $problem = $user->Problems()->wherePivot('problem_id',$problemId)->first();
        if(Gate::denies('show-participantproblem', [ $user, $problem ] )){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        if($problem->pivot->hastakenminorhint == 1 || $problem->pivot->hastakenminorhint == true){
            $request->session()->flash('flashWarning', 'Hint already taken.');
            return back();   
        }

        $user->Problems()->updateExistingPivot($problem->id , [
                    "hastried" => true,
                    "hastakenminorhint" => true,                    
                ]);
        $problem = $user->Problems()->wherePivot('problem_id',$problemId)->first();
        return view('user.showparticipantproblem')->with('user',$user)->with('problem',$problem);
    }

    /**
     * Display a the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function takeMajorhint(Request $request, $id, $problemId)
    {
        $user = User::findOrFail($id);
        $problem = $user->Problems()->wherePivot('problem_id',$problemId)->first();
        if(Gate::denies('show-participantproblem', [ $user, $problem ] )){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        if($problem->pivot->hastakenminorhint != 1 && $problem->pivot->hastakenminorhint != true){
            $request->session()->flash('flashWarning', 'Take Minor Hint First.');
            return back();   
        }
        if($problem->pivot->hastakenmajorhint == 1 || $problem->pivot->hastakenmajorhint == true){
            $request->session()->flash('flashWarning', 'Hint already taken.');
            return back();   
        }

        $user->Problems()->updateExistingPivot($problem->id, [
                    "hastried" => true,
                    "hastakenmajorhint" => true,
                    "points" => -($problem->Category->points / 2),                    
                ]);
        
        $problem = $user->Problems()->wherePivot('problem_id',$problemId)->first();
        
        $leaderboard = session()->get('leaderboard');
        $leaderboard->points += $problem->pivot->points;
        $leaderboard->save(); 
        
        return view('user.showparticipantproblem')->with('user',$user)->with('problem',$problem);
    }

    /**
     * Solve a the problem.
     *
     * @return \Illuminate\Http\Response
     */
    public function solveParticipantProblem(Request $request, $id, $problem)
    {   
        $this->validate($request, [
            'flag' => 'required|string|max:256',
        ]);
        $user = User::findOrFail($id);
        $problem = $user->Problems()->wherePivot('problem_id',$problem)->first();
        if(Gate::denies('show-participantproblem', [ $user, $problem ] )){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        if( $problem->flag == $request->flag ){
            $leaderboard = session('leaderboard');

            if($problem->pivot->hastakenmajorhint == 1 || $problem->pivot->hastakenmajorhint == true){
                $user->Problems()->updateExistingPivot($problem->id, [
                    "hastried" => true,
                    "points" => ($problem->Category->points / 2),
                    "time" => (Carbon::parse(session('starttime'))->diffInSeconds(Carbon::now()) ),
                ]);
                $leaderboard->points += ($problem->Category->points);

            }
            else if($problem->pivot->hastakenminorhint == 1 || $problem->pivot->hastakenminorhint == true){
                $user->Problems()->updateExistingPivot($problem->id, [
                    "hastried" => true,
                    "points" => ($problem->Category->points / 2),
                    "time" => (Carbon::parse(session('starttime'))->diffInSeconds(Carbon::now()) ),
                ]);
                $leaderboard->points += ($problem->Category->points/2);

            }
            else{
                $user->Problems()->updateExistingPivot($problem->id, [
                    "hastried" => true,
                    "points" => $problem->Category->points,
                    "time" => (Carbon::parse(session('starttime'))->diffInSeconds(Carbon::now()) ),
                ]);
                $leaderboard->points += $problem->Category->points;                
            }

            $leaderboard->time += Carbon::parse(session('starttime'))->diffInSeconds(Carbon::now());
            $leaderboard->save();
            $request->session()->flash('flashSuccess', 'Congratulations,Flag matched successfully...');
        }
        else{
            $request->session()->flash('flashDanger', 'Flag do not match, take another chance...');
            $user->Problems()->updateExistingPivot($problem->id, [
                    "hastried" => true,
                ]);
        }
        return view('user.showparticipantproblem')->with('user',$user)->with('problem',$problem);
    }
}
