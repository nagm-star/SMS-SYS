<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use App\Member;
use \App\User;
use \App\SMS;
use Session;

use Validator;
class SMSController extends Controller
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
        $user_id = auth()->user()->id;
        if(auth()->user()->admin)
        {
            $smss = SMS::all()->where('status',1);
            return view('sms.index')->with('smss',$smss);
        }else{
            $smss = SMS::all()->where('user_id',$user_id)->where('status',1);
            return view('sms.index')->with('smss',$smss);
        }

    }

    public function archived()
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->admin)
        {
            $smss = SMS::all()->where('status',2);
            return view('sms.archived')->with('smss',$smss);
        }else{
            $smss = SMS::all()->where('user_id',$user_id)->where('status',2);
            return view('sms.archived')->with('smss',$smss);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->admin)
        {
            $groups = Group::all();
            return view('sms.create')->with('groups',$groups);
        }else{
            $groups = Group::all()->where('user_id',$user_id);
            return view('sms.create')->with('groups',$groups);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //return redirect(route('groups.index'));
        if($request->sendto == "individual")
        {
            $this->validate($request,[
                'phone_number' => 'required|string|max:12',
                'sms_text' => 'required|min:3|max:500',
            ]);
            $sms = new SMS();
            $sms->sms_text = $request->sms_text;
            $sms->sms_length = $request->sms_page;
            $sms->phone_number = $request->phone_number;
            $sms->group_id = 0;
            $sms->user_id = auth()->user()->id;
            $sms->status = 1;
            $sms->save();
        }
        elseif($request->sendto == "group"){
            $members = Member::all()->where('group_id',$request->group_id);
            if($members->count() > 0) {
                foreach ($members as $member){
                    $sms = new SMS();
                    $sms->sms_text = $request->sms_text;
                    $sms->sms_length = $request->sms_page;
                    $sms->phone_number = $member->phone;
                    $sms->group_id = $request->group_id;
                    $sms->user_id = auth()->user()->id;
                    $sms->status = 1;
                    $sms->save(); }
                    Session::flash('success', 'You successfully send sms');
                } else {
                  Session::flash('error', 'You must add members to group');
                }

            }
                return redirect(route('sms.index'));
                
        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sms = SMS::find($id);
        return view('sms.view')->with('sms',$sms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archive($id)
    {
        $sms = SMS::find($id);
        $sms->status = 2;
        $sms->save();
        Session::flash('success', 'You successfully Archive SMS');
  
        return redirect(route('sms.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $sms = SMS::find($id);
        $sms->status = 1;
        $sms->save();
        Session::flash('success', 'You successfully Restore SMS');
  
        return redirect(route('archived'));
        
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
        //$group->members()->delete();
        Session::flash('success', 'You successfully Deleted group');
        return redirect(route('groups.index'));
    }
}
