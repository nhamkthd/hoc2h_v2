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

<section class="content">
 <div class="row">
  <div class="col-sm-12">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Category</h3>
        </div>
        <div class="panel-body">
        <div class="form">
        <form class="form-validate form-horizontal" action="{{ route('showCategory',$category->id) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group ">
          <label class="control-label col-lg-2">Parent Category ID *</label>
            <div class="col-lg-8">
              <select class=" form-control" name="super_category_id">
              <option value="0">super_category_id</option>
                @foreach($categoryall as $cateall)
                <option 
                @if($category->super_category_id == $cateall->id) {{"selected"}} @endif value="{{$cateall->id}}">{{$cateall->title}}</option>
                @endforeach
              </select>
              @if($errors->has('super_category_id'))<p style="color: red;">{{$errors->first('super_category_id')}}</p>@endif
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Title *</label>
            <div class="col-lg-8">
              <input type="text" name="title" class="form-control" value="{{$category->title}}">
              @if($errors->has('title'))<p style="color: red;">{{$errors->first('title')}}</p>@endif
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Description*</label>
            <div class="col-lg-8">
              <input type="text" name="description" class="form-control" value="{{$category->description}}">
              @if($errors->has('description'))<p style="color: red;">{{$errors->first('description')}}</p>@endif
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-offset-5 col-lg-8">
              <button type="submit" class="btn btn-default">Lưu</button>
              <button type="reset" class="btn btn-default">Thoát</button>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop