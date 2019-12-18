@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
        <h3>Update Your Profile</h3>
    </div>
    <div class="card-body">
      <div class="col-md-6 float-left">
        {!! Form::open(['action'=> ['usersController@updateprofile',$user->id] ,'method'=>'POST','enctype'=>'multipart/form-data'])!!}
                           
        <div class="form-group row">
            <div class="col-md-12">
                {{Form::text('name', $user->name,
                        [
                            "class" => "form-control",
                            "placeholder" => "Name",
                            "max-lenght" => "255",
                        ])
                }}
             <p class="red">{{$errors->first('name')}}</p>
            </div>
            
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                {{Form::text('email', $user->email,
                        [
                            "class" => "form-control",
                            "placeholder" => "Email",
                            "max-lenght" => "255",
                        ])
                }}
                 <p class="red">{{$errors->first('email')}}</p>
            </div>
           
        </div>
        
        <div class="form-group row">
            <div class="col-md-12">
               {{Form::password("password", 
               [
                  "class" => "form-control",
                  "placeholder" => "Your Password",
               ])
                }}
               <p class="red">{{$errors->first('password')}}</p>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                {{Form::password("password-confirm", 
               [
                  "class" => "form-control",
                  "placeholder" => "Re-Password",
               ])
                }}
                <p class="red">{{$errors->first('password-confirm')}}</p>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                    {{form::file('image',[
                        'class' => 'form-control'
                    ])}}
                    <p class="red">{{$errors->first('image')}}</p>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {{form::hidden('_method','PUT')}}
                {{Form::submit('Update Profile',["class"=>"btn btn-success"])}}
                {!! Form::close() !!}
            </div>
        </div>
       </div>

       <div class="col-md-6 float-right">
            <div class="col-md-4">
                <img src="{{ asset('storage\img\Profile\\'.$user->avatar)}}" class="img-bordered mt-3" style="border:1px solid #ccc" alt="" height="300px" width="300px">
            </div>
        </div>

    </div>

</div>

@endsection
