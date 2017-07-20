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
          <h3 class="box-title">Create Category</h3>
        </div>
        <div class="panel-body">
        <div class="form">
        <form class="form-validate form-horizontal" action="{{ route('getcreateCategory') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group ">
          <label class="control-label col-lg-2">Parent Category ID *</label>
             <div class="col-lg-8">
                <select name="super_category_id" class="form-control">
                  <option value="0" selected="selected">Parent Category ID</option>
                  @foreach($category as $cate)
                  <option value="{{$cate->id}}" @if(old('super_category_id')==$cate->id) selected="selected" @endif >{{$cate->title}}</option>
                  @endforeach
                </select>
                @if($errors->has('super_category_id'))<p style="color: red;">{{$errors->first('super_category_id')}}</p>@endif
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Title *</label>
            <div class="col-lg-8">
              <input type="text" name="title" class="form-control" placeholder="Tiêu đề">
              @if($errors->has('title'))<p style="color: red;">{{$errors->first('title')}}</p>@endif
            </div>
          </div>
          <div class="form-group ">
          <label class="control-label col-lg-2">Description*</label>
            <div class="col-lg-8">
              <input type="text" name="description" class="form-control" placeholder="Miêu tả">
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