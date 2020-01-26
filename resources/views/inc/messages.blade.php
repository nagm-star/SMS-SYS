<div class="container">
<div class="row">
<div class="col-md-12">

@if (session('errors'))
        <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Notification</strong>
                @foreach ($errors as $error)
                <li>{{ $error }}</li>
                @endforeach
        </div>
@endif
<!--@if (session('success'))
        <div class="alert alert-success">
                <strong>Notification</strong>{{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif-->
        @if (session('info'))
            <div class="alert alert-primary">
                    <strong>Notification</strong> {{session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
                 {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
</div>
