<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;
use Illuminate\Validation\Rule;
use Session;
use Validator;
use File;


class UsersController extends Controller
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

    // Created By Nagm

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

    // Created By Nagm

    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',

      ]);

      $user = User::create($request->all());

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
        //dd($id);
        $user = User::find($id);
        return view('admin.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        Session::flash('success', 'You successfully update user');
  
        return redirect(route('users.index'));
        //dd($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        //dd($user);

        if(!empty($user->image)) {
            $image_path = storage_path('app\public\img\Profile\\'.$user->avatar);

            if (file_exists($image_path)) {
                unlink(public_path($image_path));
            }
        }

        $user->delete();
        Session::flash('success', 'successfully Deleted');

        return redirect(route('users.index'));

    }

    public function destdroy(Request $user)
    {
        dd($user);
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


    // Created By Nagm


    public function admin($id)
    {
        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');

        return redirect(route('users.index'));
    }


    // Created By Nagm


    public function not_admin($id)
    {
        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');

        return redirect(route('users.index'));
    }


    // Created By Nagm

    public function resetPassword($id)
    {
        //dd($id);

        $user = User::find($id);

        $user->password =  Hash::make('password');

        $user->save();

        Session::flash('success', 'Successfully reset password reset');

        return redirect(route('users.index'));
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
                //'password' => 'required|string|min:8',
                //'password-confirm' => 'required|string|min:8|same:password',
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
            $image_path = storage_path('app\public\img\Profile\\'.$user->avatar);

            if (File::exists($image_path)) {
                unlink($image_path);
            }
            //Delete Old Thumbnail Img
            $image_paththumbnail = storage_path('app\public\img\Profile\thumbnail\\'.$user->avatar);
           if (File::exists($image_paththumbnail)) {
               unlink($image_paththumbnail);
           }
        }

                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->hasFile('image'))
                {
                    $user->avatar = $fileNametoStore;
                }
                if ($request->input('password'))
                //if (hasRequest('password'))
                {
                    $this->validate($request,[
                   'password' => 'required|string|min:8',
                   'password-confirm' => 'required|string|min:8|same:password',
                  ]);
                $user->password = Hash::make($request['password']);

                }

                $user->save();

                Session::flash('success', 'Your Profile Update successfully');

                return redirect("/admin/user/profile/{$user->id}");


    }
}
