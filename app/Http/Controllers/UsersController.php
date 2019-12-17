<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users'
      ]);

     $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'admin' => $request->role,
          'password' => Hash::make('password'),
      ]);

     
      Session::flash('success', 'You successfully added user');

      return redirect(route('users.index'));

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
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);

        //Delete Profile Image
        $image_path = storage_path('app\public\img\Profile\\'.$user->avatar);
            if (File::exists($image_path)) {
                unlink($image_path);
            }

        //then Delete User
        $user->delete();
        Session::flash('success', 'You successfully Deleted user');
        return redirect(route('users.index'));

    }

    public function admin($id)
    {

    }

    public function not_admin($id)
    {

    }

    //added by Debo

    public function profile($id)
    {
        
        $user  = User::findorFail($id);
        //dd($user);
        return view('admin.users.profile')->withUser($user);
    }

    public function updateprofile(Request $request, $id)
    {
        $user = User::findorFail($id);

        $validator = Validator::make($request->all(),[
                'name'=>'required|string|max:255',
                'email' => [
                    'required','string','email','max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'required|string|min:8',
                'password-confirm' => 'required|string|min:8|same:password',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
         
         }
         
        if ($request->hasFile('image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            //create filename to store
            $fileNametoStore = $filename .'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('image')->storeAs('/public/img/Profile/',$fileNametoStore);
            $path = $request->file('image')->storeAs('public/img/Profile/thumbnail/', $fileNametoStore);
            // Delete Old Image
            $image_path = storage_path('app\public\img\Profile\\'.$user->image);
            
             //dd($image_path);
            if (File::exists($image_path)) {
                unlink($image_path);
            }

            $image_paththumbnail = storage_path('app\public\img\Profile\thumbnail\\'.$user->image);
            //dd($image_path);
           if (File::exists($image_paththumbnail)) {
               unlink($image_paththumbnail);
           }
        }

                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->hasFile('image'))
                {
                    $user->image = $fileNametoStore;
                }
                $user->password = Hash::make($request['password']);

                $user->save();
                Alert::success('Success', 'User Update Successfuly !');
                return redirect("/Profile/{$user->id}");
    }
}
