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
        <link rel="stylesheet" href="{{asset('css/mdb/css/mdb.css')}}" >
        <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/ng-tags-input/ng-tags-input.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ng-selector/angular-selector.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ng-scrollbar/ng-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slide-menus/default.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slide-menus/component.css') }}">

        <!--App style-->
        <link href="{{ asset('css/angular-flash.css') }}" rel="stylesheet"> 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

         <!--scripts -->
        <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
        <script src="{{asset('js/flugin/jquery-3.2.1.min.js')}}"></script> 
        <script src="{{asset('js/flugin/angular/angular.min.js')}}"></script> 
        <script src="{{asset('js/flugin/notify/bootstrap-notify.js')}}"></script>
        <script src="{{asset('js/flugin/notify/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('js/flugin/angular/ng-tags-input.js')}}"></script> 
        <script src="{{asset('js/flugin/angular/angular-selector.js')}}"></script> 
        <script src="{{asset('js/flugin/angular/ng-infinite-scroll.js')}}"></script>
        <script src="{{asset('js/flugin/angular/ng-scrollbar.js')}}"></script> 
        <script src="{{asset('js/flugin/angular/ng-file-upload-shim.js')}}"></script> 
        <script src="{{asset('js/flugin/angular/ng-file-upload.js')}}"></script>
        <script src="{{asset('js/flugin/angular/angular-flash.js')}}"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.2/angular-sanitize.min.js"></script>
        <script src="{{asset('js/flugin/ckeditor/ckeditor.js')}}"></script>       
        <script src="{{asset('js/flugin/angular/angular-ckeditor.js')}}"></script>
        <script src="{{asset('js/flugin/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/flugin/bootstrap/ui-bootstrap-tpls-2.5.0.min.js')}}"></script>
        <script src="{{asset('js/flugin/alert/sweetalert.min.js')}}"></script>
        <script src="{{asset('js/flugin/slide-menus/modernizr.custom.js')}}"></script>
        <script src="{{asset('js/flugin/angular-chat/rltm.js')}}"></script>
        <script src="{{asset('js/flugin/angular-chat/angular-chat.js')}}"></script>

        <!-- Applycation Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/controllers/heading.js') }}"></script>
        <script src="{{ asset('js/controllers/message.js') }}"></script>
        <script src="{{ asset('js/controllers/user.js') }}"></script>
        <script src="{{ asset('js/controllers/question.js') }}"></script>
        <script src="{{ asset('js/controllers/test.js') }}"></script>
        
        <script src="{{asset('js/flugin/alert/sweetalert.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('js/flugin/alert/sweetalert.css')}}">
        <style type="text/css">
            #loading{
                background: url({{ asset('img/loading.gif') }}) center no-repeat #fff;
                position: fixed;
                left: 0px;
                top: 0px,;
                width: 100%;
                height: 100%;
                z-index: 9999
            }
            .alert-minimalist {
                background-color: rgb(241, 242, 240);
                border-color: rgba(149, 149, 149, 0.3);
                border-radius: 3px;
                color: rgb(149, 149, 149);
                padding: 10px;
            }
            .alert-minimalist > [data-notify="icon"] {
                height: 50px;
                margin-right: 12px;
            }
            .alert-minimalist > [data-notify="title"] {
                color: rgb(51, 51, 51);
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .alert-minimalist > [data-notify="message"] {
                font-size:100%;
            }
           
        </style>

    </head>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=1103517983003307";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript">
    @if(Auth::check())
        var user_id={{Auth::user()->id}}
    @else
        var user_id=0
    @endif
    </script>
    
    <body>
        <div class="loading" id="loading"></div>
        <div id="app" ng-app="Hoc2h">
            @include('layouts.navbar')
            @yield('content')
        </div>
    </body>
</html>
