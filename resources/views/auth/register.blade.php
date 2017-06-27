@extends('layouts.app')
@section('content')
<div class="container" ng-ap="register-form">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Đăng ký tài khoản
                    <a class="pull-right" href="{{ route('login') }}">Đăng nhập</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" name="regForm" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Họ tên</label>
                            <div class="col-md-6">
                                <input class="form-control" name="myname" ng-model="myname" required>
                                <span ng-show="regForm.myname.$touched && myForm.myname.$required">Trường này không được để trống.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_name" class="col-md-4 control-label">Tên đăng nhập</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="user_name" ng-model="user_name" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" ng-model="email" required>
                                <span ng-show="regForm.email.$touched && myForm.email.$$error.email">The name is required.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Đồng ý với điều khoản sử dụng.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-main">
                                   Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var app = angular.module('myApp',[]);
    app.controller('myCtrl',function($scope){
        $scope.myname = "hello";
    });

</script>
@endsection
