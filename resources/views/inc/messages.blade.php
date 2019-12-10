
<div class="container">
        <div class="row">
          <div class="col-md-12">
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         {{$error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endforeach
            @endif

{{--             @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
           </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{session('info')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
           </div>
            @endif --}}


            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

    </div>
    </div>
