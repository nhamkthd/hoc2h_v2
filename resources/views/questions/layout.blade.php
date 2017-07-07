@extends('layouts.app')
@section('content')
    <div class="container" ng-app="hoc2h-question" ng-controller="QuestionController">
        <div class="row">
            <div class="col-md-3 sidebar">
                <a href="{{route('showQuestionCreateFrom')}}"  class="btn btn-outline-default waves-effect" style="width: 100%;" >Đăng câu hỏi</a>
                <hr>
                <p class="menu-label">Thống Kê</>
                <section>
                    <ul class="menu-list">
                        <li ng-class="{active:tab === 1}">
                            <a href ="{{route('questions')}}">
                                <i class="fa fa-globe" aria-hidden="true"></i> Mới nhất 
                            </a>
                        </li>
                        <li ng-class="{active:tab === 2}">
                            <a href >
                                <i class="fa fa-flag" aria-hidden="true"></i> Nổi bật
                            </a>
                        </li>
                        <li ng-class="{active:tab === 3}">
                            <a href >
                                <i class="fa fa-fire" aria-hidden="true"></i> Nổi trong tuần 
                            </a>
                        </li>
                        <li ng-class="{active:tab === 4}">
                            <a href >
                                <i class="fa fa-user" aria-hidden="true"></i> Câu hỏi của tôi  
                            </a>
                        </li>
                        <li ng-class="{active:tab === 5}">
                            <a href ><i class="fa fa-eye" aria-hidden="true">
                                
                            </i> Đang theo dõi 
                            </a>
                            </li>
                        <li ng-class="{active:tab === 6}">
                            <a href >
                                <i class="fa fa-check-square-o" aria-hidden="true"></i> Đã được giải quyết 
                            </a>
                        </li>
                        <li ng-class="{active:tab === 7}">
                            <a href >
                                <i class="fa fa-question-circle" aria-hidden="true"></i> Chưa được giải quyết 
                            </a>
                        </li>
                        <li ng-class="{active:tab === 8}">
                            <a href >
                                <i class="fa fa-commenting-o" aria-hidden="true"></i> Chưa có câu trả lời 
                            </a>
                        </li>
                        <li ng-class="{active:tab === 9}">
                            <a href>
                                <i class="fa fa-signing" aria-hidden="true"></i> Thành viên tiêu biểu 
                            </a>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="col-md-9 main-content">
                @yield('question_content')
            </div>
        </div>
    </div>
    </div>
@endsection
