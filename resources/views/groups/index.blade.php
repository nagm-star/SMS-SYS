@extends('layouts.masterPage')


@section('content')
<div class="row">
        <div class="col-md-12">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="padding:15px 0 7px 0 !important">
                    <ol class="breadcrumb">
                        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                    </ol>
            </section>
        </div>
    </div>

<div class="">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <span class="float-right">
        <a href="{{ route('groups.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Group</a>
            </span>
        </div>
        <div class="box-body">


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Options</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($groups->count() > 0)
                        @foreach ($groups as $group)
                            <tr>
                                <td>
                                    {{ $group->group_name }}
                                </td>
                                <td>
                                    {{ $group->group_desc }}
                                </td>
                                <td>
                                <a href="{{ route('groups.edit', $group->id)}}" class="btn btn-info btn-sm">
                                        <span class="fa fa-pencil"></span> Edit
                                </a>
                                </td>
                                <td>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $group->id }})"><span class="fa fa-trash"></span> Delete </button>
                                </td>

                            </tr>
                        @endforeach


                        @else
                        <tr >
                            <th colspan="6" class="text-center">No users</th>
                        </tr>
                    @endif
            </tbody>
        </table>

        <div class="row">
                <div class="col-md-8"> {{--  {{$users->links()}} --}} </div>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade modal" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Delete Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="deleteCategoryForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <p class="text-center">
              Are you sure you want to delete this?
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
          </div>
        </form>
  
      </div>
    </div>
  </div>
@endsection

@section('scripts')

<script>

  function handleDelete(id) {
      //console.log('star.', id)
     var form = document.getElementById('deleteCategoryForm')
    // form.action = '/user/delete/' + id
     form.action = '/admin/groups/' + id
     $('#deleteModel').modal('show')
  }
</script>
@endsection