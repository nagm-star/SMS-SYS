@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Add New Group
    </div>
    <div class="card-body">

      <form action="{{ route('groups.store') }}" method="POST">
          @csrf

            <div class="form-group col-md-6">
            <label for="name">Group Name</label>
            <input required type="text" id="group_name" name="group_name" placeholder="Add Group Name" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="desc">Description</label>
                <textarea name="group_desc" class="form-control" placeholder="Add Group Description"></textarea>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-success">Add Group</button>
            </div>
        </form>
    </div>

</div>

@endsection
