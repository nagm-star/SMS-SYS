@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Update user profile
    </div>
    <div class="card-body">

      <form action="{{ route('users.store') }}" method="POST">
          @csrf

            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                <input required type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input required type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input required type="text" id="phone" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="role">Role </label><br>
                <select name="role" id="role" class="form-control form-control col-md-4">
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-success">Add user</button>
            </div>
        </form>
    </div>

</div>

@endsection
