<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Hoc2H') }}</title>

    <!--  bootstrap styles -->
    <link  href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link  href="{{asset('css/bootstrap/animate.min.css')}}" rel="stylesheet">
    <link  href="{{asset('css/bootstrap/bootstrap-dropdownhover.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script src="{{asset('js/flugin/angular.min.js')}}"></script>
</head>
<body ng-ap = "myApp" ng-controller="myCtrl">
    <div id="app">
        <nav class="navbar navbar-default fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a style="color: #1C2331; font-size: 18px;" class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-animations" data-hover="dropdown"  data-animations="fadeInDown">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="#nothing">Lớp học</a></li>
                        <li><a href="{{url('tests/')}}">Đề Thi</a></li>
                        <li><a href="{{url('questions/')}}">Hỏi Đáp</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false" >Danh Mục <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdownhover-bottom" role="menu" >
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false" ><span class="caret"></span>Kiến Thức THPT</a>
                                    <ul class="dropdown-menu dropdownhover-left " role="menu" >
                                        <li><a href="#nothing">Lớp 12</a></li>
                                        <li><a href="#nothing">Lớp 11</a></li>
                                        <li><a href="#nothing">Lớp 10</a></li>
                                          {{-- @foreach($superCategories as $superCategory)
                                          @include('layouts.recursive_menu', $superCategory)
                                          @endforeach --}}
                                    </ul>
                                </li>
                                <li><a href="#nothing">Kiến Thức THCS</a></li>
                                <li><a href="#nothing">Ngoại Ngữ</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                            <li><a href="{{ route('register') }}">Đăng Ký</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#nothing">Trang cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           Đăng xuất
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('js/flugin/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/flugin/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/flugin/bootstrap/bootstrap-dropdownhover.min.js')}}"></script>

     <!--  angular js framework -->
   
    <script src="{{ asset('js/app.js') }}"></script>

</body>
    <script type="text/javascript">
            
    </script>
</html>
