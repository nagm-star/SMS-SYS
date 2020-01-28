<?php
/**********************
    File Name   : MembersController.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Imports\MemberImport;
use App\Group;
use App\User;
use App\Member;
use Maatwebsite\Excel\facades\Excel;
use Illuminate\Http\Request;
use Validator;
use Importer;
use Session;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $members = Member::all();
        if(auth()->user()->admin)
        {
            $members = Member::all();
            return view('members.index')->with('members',$members);
        }else{
            $members = Member::all()->where('user_id',$user_id);
            return view('members.index')->with('members',$members);
        }

        //$members = Member::orderBy('created_at','desc')->paginate(10);
       // return view('members.index',compact('members') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();

        if($groups->count() == 0)
        {
          Session::flash('info', 'You must add group befor attempting to create member');
          return redirect()->back();
        }

        return view('members.create')->with('groups', Group::all());
    }

    public function add()
    {
        $groups = Group::all();

        if($groups->count() == 0)
        {
          Session::flash('info', 'You must add group befor attempting to create member');
          return redirect()->back();
        }

        return view('members.addMember')->with('groups', Group::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'phone' => 'required|numeric',
            'group_id' => 'required'
        ]);  // QueryException

        if($validator->passes())
        {

            $member = new Member();
            $member->name = $request->name;
            $member->phone = $request->phone;
            $member->group_id = $request->input('group_id');
            $member->user_id = auth()->user()->id;
            $member->save();

            Session::flash('success', 'You successfully added user');

            return redirect(route('members.index'));
        }

        else {

            return redirect()->back()
             ->with(['errors' => $validator->errors()->all()]);
        }
    }

    // add single member
    public function addMember(Request $request)
    {
        dd($request->all());

        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|max:191',
            'group_id' => 'required'
        ]);

        if($validator->passes())
        {
            $member = new Member();
            $member->name = $request->name;
            $member->phone = $request->phone;
            $member->groupy_id = $request->input('group_name');
            $member->save();

            Session::flash('success', 'You successfully added user');

            return redirect(route('members.create'));
        }

        else {
            Session::flash('errors', 'Faild to add user');

            return redirect(route('members.create'));
        }
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
    public function edit(member $member)
    {
        return view('members.addMember')->with('member', $member)->with('groups', Group::all());
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
        //dd($request->all());
        $member = Member::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:191',
            'group_id' => 'required'
        ]);

        if($validator->passes())
        {

            $member->name = $request->name;
            $member->phone = $request->phone;
            $member->group_id = $request->input('group_id');
            $member->save();

            Session::flash('success', 'You successfully updated member');

            return redirect(route('members.index'));
        }

        else {

            return redirect()->back()
             ->with(['errors' => $validator->errors()->all()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        Session::flash('success', 'You successfully deleted member');

        return redirect(route('members.index'));
    }


    public function export()
    {
        return Excel::download(new MemberExport(), 'members.xlsx');
    }


    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($validator->passes())
        {
            $members = Excel::toCollection(new MemberImport(), $request->file('import_file'));
            //dd($request->input('group_id'));
            try {
                foreach($members[0] as $member) {
                    Member::where('id', $member[0])->create([
                        'name' => $member[1],
                        'phone' => $member[2],
                        'group_id' => $request->input('group_id'),
                        //'user_id' =>  $request->input('user_id')
                        'user_id' =>   $request->input('user_id')


                    ]);
                }
                return redirect(route('members.index')); //ErrorException (E_NOTICE)
            } catch(\ErrorException $e) {
                return redirect()->back()
                ->with(['error' => 'Rows not match']);
            }

            catch(\Illuminate\Database\QueryException $e) {
                dd($e->getMessage());
                return redirect()->back()
                ->with(['error' => 'Coulmn in excel file not matched in database' ]);
            }

        }

    else {
       return redirect()->back()
             ->with(['errors' => $validator->errors()->all()]);
    }
 }
}
