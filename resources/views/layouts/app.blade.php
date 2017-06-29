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
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    </head>
    <body ng-app = "hoc2h-app">
        <div id="app">
            @include('layouts.navbar')
            @yield('content')
        </div>
        <!--scripts -->
        <!-- Angular Material Dependencies -->
        <script src="{{asset('js/flugin/angular.min.js')}}"></script>     
        <!-- Applycation Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/controllers/question.js') }}"></script>
    </body>
</html>
