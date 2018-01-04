<!DOCTYPE html>
<html>
<head>
    <title>Student Panel</title>
    <!-- Bootstrap CSS CDN -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Our Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/navigation.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <h3>Student Panel</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Menu</p>
                <li><a href="/student/grades">Dashboard</a></li>
            </ul>

        </nav>

        <!-- Page Content -->
        <div id="content" style="width:100%;">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!-- <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="glyphicon glyphicon-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button> -->
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown profile">
                                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><img src="/storage/{{ Auth::user()->avatar }}" class="profile-img"> <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-animated">
                                    <li class="profile-img">
                                        <img src="/storage/{{ Auth::user()->avatar }}" class="profile-img">
                                        <div class="profile-body">
                                            <h5>{{ Auth::user()->name }}</h5>
                                            <h6>{{ Auth::user()->email }}</h6>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="class-full-of-rum">
                                        <a href="/student/profile/4">
                                            <i class="voyager-person"></i>Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/" target="_blank">
                                            <i class="voyager-home"></i>Home
                                        </a>
                                    </li>
                                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                                    @if(is_array($nav_items) && !empty($nav_items))
                                    @foreach($nav_items as $name => $item)
                                    <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                                        @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                                        <form action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-block">
                                                @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                                <i class="{!! $item['icon_class'] !!}"></i>
                                                @endif
                                                {{$name}}
                                            </button>
                                        </form>
                                        @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div style="padding: 20px;">
                @yield('content')
            </div>

        </div>
    </div> 

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
      });
    </script>

</body>
</html>