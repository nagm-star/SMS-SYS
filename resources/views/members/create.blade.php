<?php
/**********************
    File Name   : create.blade.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/
?>
@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            Add New Member
    </div>
    <div class="card-body">

      <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group col-md-6">
                <label for="import_file">Upload Excel File</label>
                <input  type="file" id="import_file" name="import_file" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="group_id">Assign Group</label>
                <select name="group_id" id="group_id" class="form-control">
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}"

                            @if(isset($member))
                                @if($group->id == $member->id)
                                selected
                                @endif
                            @endif>

                            {{ $group->group_name}}

                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <button class="btn btn-success">Add to group</button>
            </div>
        </form>
    </div>

</div>

@endsection
