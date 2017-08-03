@extends('layouts.app')
@section('content')
    <div class="container app-content" ng-app="hoc2h-user" ng-controller="UserController">
        <div class="row">
            @yield('user_content')
        </div>
    </div>
@endsection
