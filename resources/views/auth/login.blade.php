
@extends('layouts.app')
@section('content')
<style type="text/css">
    .card {padding: 20px;} 
    .form-elegant .font-small {font-size: 0.8rem; }
    .form-body {margin-top: 60px;}
    .question-lable {margin-bottom: 20px; margin-top:10px; float: right;}
    .social-button {width: 28px;}
    .social-button i {text-align: center;}
</style>
<div class="container ">
    <div class="row ">
        <div class="col s6 offset-s3">
            <section class="form-elegant">
                <!--Form without header-->
                <form role="form" method="POST" action="{{ route('login') }}" novalidate>
                     {{ csrf_field() }}
                    <div class="card">
                        <div class="card-body">
                            <!--Header-->
                            <div class="text-center">
                                <h5 class="dark-grey-text"><strong>Đăng Nhập</strong></h5>
                            </div>
                            <!--Body-->
                            <div class="form-body">
                                <div class="input-field">
                                    <input placeholder="Email" type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                                    <label for="first_name">Địa chỉ email</label>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="input-field">
                                    <input placeholder="Mật khẩu" id="password" type="password" class="form-control" name="password" require>
                                    <label for="first_name">Mật khẩu</label>
                                    <p class="font-small">Quên <a href="{{ route('password.request') }}" class="blue-text ml-1"> mật khẩu?</a></p>
                                </div>
                            </div>
                            <button style="width: 100%; margin-top: 20px;" class="waves-effect waves-light btn">Đăng Nhập</button> 
                            <p style="text-align: center;" class="font-small"> hoặc đăng nhập bằng</p>

                            <div class="">
                                    <!--Facebook-->
                                <button class="btn waves-effect waves-light social-button" type="button" class=""><i class="fa fa-facebook"></i></button>
                                    <!--Google +-->
                                <button class="btn waves-effect waves-light social-button" type="button" class=""><i class="fa fa-google-plus "></i></button>
                            </div>
                        </div>
                        <!--Footer-->
                        <div >
                            <p class="font-small text-right">Chưa là thành viên? <a href="{{ route('register') }}" class="blue-text ml-1"> Đăng ký</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>  
<!-- <div class="container ">
    <div class="row ">
        <div class="ng-scope col-md-8 col-md-offset-2">
            <div class="box" style="background-color: #fff;">
                <div class="form-heading">
                    <h4>Đăng Nhập  
                        <a class="pull-right" href="{{ route('register') }}">Đăng ký</a></h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email / Tên đăng nhập</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Ghi nhớ đăng nhập
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 10px; font-size: 13px;">
                                 <a style="text-decoration:underline;" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" style="padding:10px;">
                                <button type="submit" class="btn btn-default">
                                    Đăng nhập
                                </button>
                                 <a href="{{ url('redirect') }}" class="btn btn-indigo facebook-color pull-right">
                                   <i class="fa fa-facebook-square" aria-hidden="true"></i> Đăng nhập bằng facebook
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 -->
@endsection
