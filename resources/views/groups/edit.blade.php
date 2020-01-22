@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Update group details
    </div>
    <div class="card-body">

      <form action="{{route('groups.update',$group->id) }}" method="POST">
          @csrf

          @method('PUT')
            <div class="form-group col-md-6">
                <label for="name">Group Name</label>
                <input required type="text" id="group_name" name="group_name" class="form-control" value="{{$group->group_name}}">
            </div>
            <div class="form-group col-md-6">
                <label for="desc">Description</label>
                <textarea name="group_desc" class="form-control">{{$group->group_desc}}</textarea>
            </div>     
            <div class="form-group col-md-6">
                <button class="btn btn-success">Update Group</button>
            </div>
        </form>
    </div>

</div>

@endsection
