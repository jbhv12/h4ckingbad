<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\AccessGroup;

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
        return view('accessgroup.index')->with('accessgroups',$accessgroups);
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
        $users = $accessgroup->users()->get();
        return $users;
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
}
