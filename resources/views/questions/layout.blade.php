@extends('layouts.app')
@section('content')
    <div class="container" ng-app="hoc2h-question" ng-controller="QuestionController as question">
        <div class="row">
            <div class="col-md-3 sidebar">
                <a href="{{route('showQuestionCreateFrom')}}"  class="btn btn-main" style="width: 100%;" >Đăng câu hỏi</a>
                <hr>
                <p class="menu-label">Thống Kê</>
                <section>
                    <ul class="menu-list">
                        <li ng-class="{active:question.tab === 1}"><a href > Mới nhất </a></li>
                        <li ng-class="{active:question.tab === 2}"><a href > Nổi bật</a></li>
                        <li ng-class="{active:question.tab === 3}"><a href >Nổi trong tuần </a> </li>
                        <li ng-class="{active:question.tab === 4}"><a href > Câu hỏi của tôi  </a></li>
                        <li ng-class="{active:question.tab === 5}"><a href > Đang theo dõi </a></li>
                        <li ng-class="{active:question.tab === 6}"><a href > Đã được giải quyết </a></li>
                        <li ng-class="{active:question.tab === 7}"><a href > Chưa được giải quyết </a></li>
                        <li ng-class="{active:question.tab === 8}"><a href > Chưa có câu trả lời </a></li>
                        <li ng-class="{active:question.tab === 9}"><a href> Thành viên tiêu biểu </a></li>
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
