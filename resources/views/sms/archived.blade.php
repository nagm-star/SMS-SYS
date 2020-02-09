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
<!--         <div class="box-header">
            <h3 class="box-title"></h3>
            <span class="float-right">
        <a href="{{ route('sms.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> New SMS</a>
            </span>
        </div> -->
        <div class="box-body">


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>SMS Text</th>
                        <th>Phone</th>
                        <th>Pages</th>
                        <th>Group</th>
                        <th>Created By</th>
                        <th>Options</th>
                    </tr>
                </thead>

                <tbody>
                        @if ($smss->count() > 0)
                        @foreach ($smss as $index =>$sms)
                            <tr>
                                <td>
                                    {{ $index +1 }}
                                </td>
                                <td>
                                    {{ $sms->sms_text }}
                                </td>
                                <td>
                                    {{ $sms->phone_number }}
                                </td>
                                <td>
                                    {{ $sms->sms_length }}
                                </td>
                                <td>
                                    @if($sms->group_id==0)
                                        {{"Individual"}}
                                        @else
                                        {{ $sms->group->group_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $sms->user->name }}
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="handleRestore({{ $sms->id }})"><span class="fa fa-recycle"></span> Restore </button>
                                </td>

                            </tr>
                        @endforeach


                        @else
                        <tr >
                            <th colspan="6" class="text-center">No SMS</th>
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
          <h5 class="modal-title text-center" id="exampleModalLabel">Restore Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="GET" id="deleteCategoryForm">
          @csrf
          <div class="modal-body">
            <p class="text-center">
              Are you sure you want to restore this sms?
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">No, Cancel</button>
            <button type="submit" class="btn btn-warning">Yes, Restore</button>
          </div>
        </form>
  
      </div>
    </div>
  </div>
@endsection

@section('scripts')

<script>

function handleRestore(id) {
      //console.log('star.', id)
     var form = document.getElementById('deleteCategoryForm')
    // form.action = '/user/delete/' + id
     var url = '{{ route("sms.restore", ":id")}}';
     form.action = url.replace(':id',id);
     $('#deleteModel').modal('show')
  }
</script>
@endsection