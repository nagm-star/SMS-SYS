<?php
/**********************
    File Name   : addMember.blade.php
    Author Name : Nagm Eldin Yousif
    Created On  : 23-1-2020
***********************/
?>
@extends('layouts.masterPage')

@section('content')

<div class="card card-default">

    <div class="card-header">
            {{ isset($member) ? 'Edit Member' : 'Add New Member'}}
    </div>
    <div class="card-body">

     <form action="{{ isset($member) ? route('members.update', $member->id) : route('members.store') }}" method="post" enctype="multipart/form-data">

            @csrf
          @if (isset($member))
              @method('PUT')
          @endif

            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input  type="text" id="name" name="name"  value="{{isset($member) ? $member->name : ''}}" placeholder="Member Name" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input required type="text" id="phone" name="phone"   value="{{isset($member) ? $member->phone : ''}}" placeholder="Member Phone" class="form-control">

                <div class="">
                   <ul class="list-group">
                     @foreach($errors as $error)
                     <li class="list-group-item text-danger" style="border:none !important; padding:0 !important;">
                       {{ $error }}
                     </li>
                     @endforeach
                   </ul>
                </div>

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
                <button class="btn btn-success">
                 {{ isset($member) ? 'Update Member' : 'Add Member' }}

                </button>
            </div>
        </form>
    </div>

</div>

@endsection
