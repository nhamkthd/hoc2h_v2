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
<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-header col-sm-12">
        <div class="col-sm-2">
          <a href="{{url('admin/category/create')}}" class="btn btn-block btn-default">Tạo mới danh mục</a>
        </div>
      </div>
      <div class="col-sm-12">
        @if(session('notify'))
        <div class="alert bg-teal disabled color-palette">
          {{session('notify')}}
        </div>
        @endif
      </div>
      <div class="box-body">
        @include('admin.business.category.listcategory')
      </div>
    </div>
  </div>
</div>
</section>
@stop