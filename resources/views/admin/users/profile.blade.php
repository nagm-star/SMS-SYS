@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
      {{ isset($user) ? 'Edit user: '  .$user->name : 'Create User' }}
    </div>
    <div class="card-body">
      <div class="col-md-6 float-left">
      <form action="{{ route('user.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
          @csrf

          @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input  type="text" id="name" name="name" class="form-control" value="{{isset($user) ? $user->name : ''}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input  type="email" id="email" name="email" class="form-control" value="{{isset($user) ? $user->email : ''}}">
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" >
            </div>

            <div class="form-group">
                <label for="avatar">Upload new avatar</label>
                <input type="file" id="avatar" name="avatar" class="form-control">
            </div>
           <div class="form-group">
                <button class="btn btn-success">Update profile</button>
            </div>
        </form>
       </div>

       <div class="col-md-6 float-right">
            <div class="col-md-4">
                <img src="{{ asset('storage\img\Profile\\'.$user->avatar)}}" class="img-bordered mt-3" style="border:1px solid #ccc" alt="" height="300px" width="300px">
            </div>
        </div>

    </div>

</div>

@endsection
