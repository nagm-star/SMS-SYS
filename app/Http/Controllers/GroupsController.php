<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;

use Session;

use Validator;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $groups = Group::all();
        return view('groups.index')->with('groups',$groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'group_name' => 'required|string|max:191',
            'group_desc' => 'required|min:3|max:500',
      ]);
        $group = new Group();
        $group->group_name = $request->group_name;
        $group->group_desc = $request->group_desc;
        $group->user_id = auth()->user()->id;
        $group->save();
      //$group = Group::create($request->all());

      Session::flash('success', 'You successfully added group');

      return redirect(route('groups.index'));

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
        $group = Group::find($id);
        return view('groups.edit')->with('group',$group);
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
        $group = Group::find($id);
        $group->group_name = $request->group_name;
        $group->group_desc = $request->group_desc;
        $group->user_id = auth()->user()->id;
        $group->save();
        Session::flash('success', 'You successfully update Group');
  
        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        $group = Group::findorFail($id);

        //then Delete Group
        $group->delete();
        Session::flash('success', 'You successfully Deleted group');
        return redirect(route('groups.index'));
    }
}
