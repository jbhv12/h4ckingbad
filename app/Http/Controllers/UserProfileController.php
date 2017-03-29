<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\UserProfile;
use App\User;
use App\AccessGroup;

class UserProfileController extends Controller
{
    /**
     * Instantiate a new ProblemController instance.
     */
    public function __construct()
    {
        $this->middleware('auth', [
            "except" => ['create','store']
          ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userprofile.create');
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
            'teamname' => 'required|string|max:128|unique:userprofiles,teamname',
            'firstmembername' => 'required|string|max:128',
            'secondmembername' => 'required|string|max:128',
            'firstmemberemail' => 'required|email|unique:userprofiles,firstmemberemail|unique:users,email',
            'secondmemberemail' => 'required|email',
            'firstmembermobile' => 'required|numeric|digits:10',
            'secondmembermobile' => 'required|numeric|digits:10',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'terms' => 'accepted',
           
        ]);

        $user = new User;
        $user->name = $request->teamname;
        $user->email = $request->firstmemberemail;
        $user->password = bcrypt($request->password);
        $user->save();

        $userprofile = new UserProfile;
        $userprofile->user_id = $user->id;
        $userprofile->teamname = $request->teamname;
        $userprofile->firstmembername = $request->firstmembername;
        $userprofile->firstmemberemail = $request->firstmemberemail;
        $userprofile->firstmembermobile = $request->firstmembermobile;
        $userprofile->secondmembername = $request->secondmembername;
        $userprofile->secondmemberemail = $request->secondmemberemail;
        $userprofile->secondmembermobile = $request->secondmembermobile;
        $userprofile->save();

        $participantGroup = AccessGroup::participantGroup();
        $user->AccessGroups()->save($participantGroup);

        $request->session()->flash('flashSuccess', 'Team Created Successfully...Login Now');

        return view('auth.login');
        
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
        $userprofile = UserProfile::findOrFail($id);
        if(Gate::denies('edit-userprofile', $userprofile)){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        return view('userprofile.edit')->with('userprofile',$userprofile);
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
        $userprofile = UserProfile::with('User')->findOrFail($id);
        if(Gate::denies('edit-userprofile', $userprofile)){
            $request->session()->flash('flashDanger', 'UnAutherized Access Detected.');
            return back();
        }
        $this->validate($request, [
            'teamname' => 'required|string|max:128|unique:userprofiles,teamname,' . $userprofile->id . ',id',
            'firstmembername' => 'required|string|max:128',
            'secondmembername' => 'required|string|max:128',
            'secondmemberemail' => 'required|email',
            'firstmembermobile' => 'required|numeric|digits:10',
            'secondmembermobile' => 'required|numeric|digits:10',
        ]);

        $user = User::findOrFail($userprofile->user->id);
        $user->name = $request->teamname;
        $user->save();

        $userprofile->teamname = $request->teamname;
        $userprofile->firstmembername = $request->firstmembername;
        $userprofile->firstmembermobile = $request->firstmembermobile;
        $userprofile->secondmembername = $request->secondmembername;
        $userprofile->secondmemberemail = $request->secondmemberemail;
        $userprofile->secondmembermobile = $request->secondmembermobile;
        $userprofile->save();

        $request->session()->flash('flashSuccess', 'Team Profile Updated Successfully...');

        return redirect()->route('team.edit',$userprofile->id);
        
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
}
