<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserProfile;
use App\User;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'firstmemberemail' => 'required|email',
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

        $request->session()->flash('flashSuccess', 'Team Created Successfully...Login Now');

        return view('auth.login');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
