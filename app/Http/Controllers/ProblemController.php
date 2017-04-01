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
}