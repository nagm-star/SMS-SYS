
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel</title>
  <link rel="icon" href="{{asset('img/favicon.icon')}}" type="image/x-icon"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
{{--   <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
 --}}  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
  <link rel="stylesheet" href="{{asset('Ionicons/css/ionicons.min.css')}}">

  @yield('styles')

  </head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper" id="app">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <img src="{{asset('img/login2.png')}}" class="img-circle" alt="User Image">
      {{-- <span class="logo-lg"><b>SMS</b>NIC</span> --}}
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                  <!-- Menu Toggle Button -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    <img src="{{ asset('storage\img\Profile\\'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                      <img src="{{ asset('storage\img\Profile\\'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">

                      <p>
                            {{Auth::user()->name}}
                        <small>
                                @if ( Auth::user()->admin == 1)
                                <p style="font-weight: normal">Administrator</p>
                                @else
                                <p style="font-weight: normal">User</p>
                                @endif</small>
                      </p>
                    </li>

                    <!-- Menu Footer-->
                    <li class="user-footer">
                       <div class="pull-left">
                        <a href="/admin/user/profile/{{Auth::user()->id}}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                      </div> 
                      <div class="pull-right">
                            <a class="btn btn-default btn-flat"  href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                            </form>
                      </div>
                    </li>
                  </ul>
                </li>

              </ul>
            </div>
          </nav>

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
           <img src="{{ asset('storage\img\Profile\\'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <!-- Status -->

              @if ( Auth::user()->admin == 1)
              <p style="font-weight: normal">Administrator</p>
              @else
              <p style="font-weight: normal">User</p>
              @endif

        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard blue"></i> <span>Dashboard</span></a></li>
        {{-- @can('isAdmin') --}}

      {{--  @endcan --}}
        <li class="treeview">
            <a href="#"><i class="fa fa-cogs red"></i> <span>SMS Management</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-paper-plane"></i> <span>Bulk Management</span></a></li>
            </ul>
        </li>
        @if(Auth::user()->admin)
        <li class="treeview">
                <a href="#"><i class="fa fa-group orange"></i> <span>Admin Console</span>
                  <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                        <li><a href="{{route('users.index')}}"><i class="fa fa-group"></i> <span>Users</span></a></li>
                </ul>
        </li>
        @endif

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">
        @include('inc.messages')

        @yield('content')

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Date:
        @php
        $mytime = Carbon\Carbon::now();
        echo $mytime->toDateTimeString();
        @endphp
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">NIC</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
</div>

@auth
        <script>
            window.user = @json(auth()->user());
        </script>
@endauth

<script src="js/app.js"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="{{asset('js/load.js')}}"></script>

    <script>
       @if(Session::has('success'))
          toastr.success("{{ Session::get('success') }}")
       @elseif(Session::has('info'))
          toastr.info("{{ Session::get('info') }}")
       @endif
    </script>


@yield('scripts')

</body>
</html>
