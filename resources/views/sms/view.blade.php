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
           View SMS
    </div>
    <div class="card-body">

<!--     $sms->sms_text = $request->sms_text;
    $sms->sms_length = $request->sms_page;
    $sms->phone_number = $member->phone;
    $sms->group_id = $request->group_id;
    $sms->user_id = auth()->user()->id;
    $sms->status = 1; -->

      <h5>TEXT : {{ $sms->sms_text }}</h5>
       
            @if( $sms->group_id == 0  ) 
      <h5>PHONE : {{ $sms->phone_number }}</h5>
            <h5>GROUP NAME :  Individual </h5>
             @else 

        <h5>  GROUP Name: {{ $sms->group->group_name }} </h5>
            
            @endif
      <h5>SENT BY : {{ $sms->user->name }}</h5> 

    <a href="{{ route('sms.index') }}" class="btn btn-success">   <span class="fa fa-arrow-left"></span> Back
     </a>
    </div>
</div>

@endsection
