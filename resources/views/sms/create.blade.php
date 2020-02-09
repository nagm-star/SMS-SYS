@extends('layouts.masterPage')

@section('content')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    function group_check(){
        var group = document.getElementById("group");
        var individual = document.getElementById("individual");
        group.style.display =  "block";
        individual.style.display =  "none";
    }
    function individual_check(){
        var group = document.getElementById("group");
        var individual = document.getElementById("individual");
        group.style.display =  "none";
        individual.style.display =  "block";
    }
    $(document).ready(function(){
		$('#sms_text').on('keyup',function(){
		   var charCount = $(this).val().length;
           var page;
           //if (isEnglish(e.charCode))
           //page = charCount / 160;
          // else
           page = charCount / 70;
			$("#result").text(charCount + " chars / " + parseInt(page+1) +" Page");
            document.getElementById("page").value = parseInt(page+1);
		});
	});
    /*
    function isEnglish(charCode){
    return (charCode >= 97 && charCode <= 122) 
          || (charCode>=65 && charCode<=90);
    }
    */
</script>

<div class="card card-default">

    <div class="card-header">
            Add New SMS
    </div>
    <div class="card-body">

      <form action="{{ route('sms.store') }}" method="POST">
          @csrf
            <input type="hidden" name="sms_page" id="page" value="">
            <div class="form-group col-md-6">
            <label for="name">Send To</label><br>
            <input type="radio" name="sendto" value="group" onclick="group_check()" checked> Group
            <input type="radio" name="sendto" value="individual" onclick="individual_check()"> Individual
            </div>
            <div id="individual" class="form-group col-md-6" style="display:none">
            <label for="name">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="249XXXXXXXXX" class="form-control">
            </div>
            <div id="group" class="form-group col-md-6">
            <label for="name">Group Name</label>
            <select id="group_name" name="group_id" class="form-control">
                <option>Select Group</option>
                @if ($groups->count() > 0)
                        @foreach ($groups as $index => $group)
                        <option value="{{$group->id}}">{{$group->group_name}}</option>
                        @endforeach
                @endif
            </select>
            </div>
            <div class="form-group col-md-6">
                <label for="sms_text">SMS Text</label><label id="result" for="char" style="float:right">0 chars /0 Page</label>
                <textarea id="sms_text" name="sms_text" class="form-control" placeholder="Add SMS Text"></textarea>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-success">Send SMS</button>
            </div>
        </form>
    </div>

</div>

@endsection
