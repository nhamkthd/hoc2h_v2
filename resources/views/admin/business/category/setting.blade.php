@extends('admin.layouts.master')
@section('content')

<section class="content-header">
  <h1>
    Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Category</li>
  </ol>
</section>
<!-- list account -->

<section class="content" ng-app="hoc2h-category" ng-controller="setting_itemCtrl">
  @verbatim
  <div ng-nestable ng-model="items" class="cf nestable-lists">
    <div>
      {{$item.id}}
    </div>
  </div>
  @endverbatim
</section>
@section('script')
@endsection
@stop