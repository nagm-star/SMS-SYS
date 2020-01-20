@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Update user profile
    </div>
    <div class="card-body">

      <form action="{{ route('users.update',$user->id) }}" method="POST">
          @csrf

          @method('PUT')
            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                <input required type="text" id="name" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input required type="text" id="phone" name="phone" class="form-control" value="{{$user->phone}}">
            </div>
            
            <div class="form-group col-md-6">
                <button class="btn btn-success">Update user</button>
            </div>
        </form>
    </div>

</div>

@endsection
