@extends('layouts.app')
@section('content')
    <div class="container app-content" ng-app="hoc2h-question" ng-controller="QuestionController">
        <div class="row">
            <div class="col-md-8 main-content">
                @yield('question_content')
            </div>
            <div class="col-md-4">
                @include('questions.sidebar')
            </div>
        </div>
    </div>
@endsection
