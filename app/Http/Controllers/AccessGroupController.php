<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\AccessGroup;
use App\User;

class AccessGroupController extends Controller
{
    /**
     * Instantiate a new AccessGroupController instance.
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
        $accessgroups = AccessGroup::all();
        $adminGroup = AccessGroup::adminGroup();
        return view('accessgroup.index')->with('accessgroups',$accessgroups)->with('adminGroup', $adminGroup);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessgroup.create');
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
            'name' => 'required|string|max:64|unique:accessgroups,name',
        ]);

        $accessgroup = new AccessGroup;
        $accessgroup->name = $request->name;
        $accessgroup->save();

        $request->session()->flash('flashSuccess', 'AccessGroup Created Successfully');

        return redirect()->route('accessgroup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accessgroup = AccessGroup::findOrFail($id);
        $users = $accessgroup->users()->paginate(25);
        
        return view('accessgroup.show')->with('accessgroup', $accessgroup)->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
    public function destroy($id)
    {
        $request->session()->flash('flashWarning', 'This feature is disabled till Techfest');
        return back();
    }

    /**
     * Remove the user from this group.
     *
     * @param  int  $accessgroup
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function destroyUserAccessGroup(Request $request, $accessgroup , $user)
    {
        $user = User::findOrFail($user);
        $accessgroup = AccessGroup::findOrFail($accessgroup);

        $user->AccessGroups()->detach($accessgroup);

        $request->session()->flash('flashSuccess', 'User Removed from this Access Group');
        
        return redirect()->route('accessgroup.show', $accessgroup->id);
    }

    /**
     * Show a Page to add new user in this group.
     *
     * @param  int  $accessgroup
     * @return \Illuminate\Http\Response
     */
    public function createUserAccessGroup(Request $request, $accessgroup)
    {
        $accessgroup = AccessGroup::findOrFail($accessgroup);

        return view('accessgroup.createuseraccessgroup')->with('accessgroup', $accessgroup);
    }

    /**
     * Add new user in this group.
     *
     * @param  int  $accessgroup
     * @return \Illuminate\Http\Response
     */
    public function storeUserAccessGroup(Request $request, $accessgroup)
    {   
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);

        $accessgroup = AccessGroup::findOrFail($accessgroup);
        $user = User::where('email',$request->email)->first();

        if($user->AccessGroups->contains($accessgroup)){
            $request->session()->flash('flashWarning', 'User is already in this group');
        }
        else{
            $user->AccessGroups()->attach($accessgroup);
            $request->session()->flash('flashSuccess', 'User Added to this Access Group');
        }

        return redirect()->route('accessgroup.show', $accessgroup->id);
    }
}
