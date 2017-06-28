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
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    
</head>
<body ng-app = "hoc2h-app">
    <div id="app">
        <md-toolbar class="md-hue-2">
            <div class="md-toolbar-tools">
             <md-button class="nav-btn">Hoc2H</md-button>
            </div>
        </md-toolbar>

        @yield('content')
    </div>
    <!--scripts -->
    <script src="{{asset('node_modules/angular/angular.min.js')}}"></script>
    <script src="{{asset('node_modules/angular-animate/angular-animate.min.js')}}"></script>
    <script src="{{asset('node_modules/angular-aria/angular-aria.min.js')}}"></script>
    <script src="{{asset('node_modules/angular-material/angular-material.min.js')}}"></script>
    <script src="{{asset('node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js')}}"></script>
    <!-- Applycation Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/controllers/question.js') }}"></script>
</body>
</html>
