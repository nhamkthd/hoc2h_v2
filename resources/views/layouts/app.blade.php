<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Hoc2H') }}</title>
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('js/flugin/alert/sweetalert.css')}}">
        <link rel="stylesheet" href="{{asset('mdb/css/mdb.css')}}" >
        <link rel="stylesheet" href="{{asset('mdb/css/style.css')}}" >
        <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.css') }}"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
        <!--App style-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
        
         <!--scripts -->
        
        <script src="{{asset('js/flugin/jquery-3.2.1.min.js')}}"></script> 
        <script src="{{asset('js/flugin/angular.min.js')}}"></script> 
        <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ckeditor/1.0.3/angular-ckeditor.js"></script>
        <script src="{{asset('js/flugin/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/flugin/bootstrap/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>
        <script src="{{asset('js/flugin/alert/sweetalert.min.js')}}"></script>

        <!-- Applycation Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/controllers/question.js') }}"></script>
        <script src="{{ asset('js/controllers/test.js') }}"></script>
    
       
        
        <style type="text/css">
            #loading{
                background: url({{ asset('images/loading.gif') }}) center no-repeat #fff;
                position: fixed;
                left: 0px;
                top: 0px,;
                width: 100%;
                height: 100%;
                z-index: 9999
            }
        </style>

    </head>
    <body>
        <div class="loading" id="loading"></div>

        <div id="app" ng-app="Hoc2h">
            @include('layouts.navbar')
            @yield('content')
        </div>
    </body>
    </body>
</html>
