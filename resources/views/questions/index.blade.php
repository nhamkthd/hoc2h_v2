@extends('questions.layout')
@section('question_content')
	<style type="text/css">
		/*sort tab style*/
		.search-form {margin-bottom: 20px; padding-left: 0;}
		.tab-bar{padding-left: 0;}
		.question-tab-header { clear: both;padding:10px 0; color: #4285F4;}
		.question-tab-header h3 {float: left; margin-bottom: 0px; font-weight: normal; font-size:18px; margin-bottom: 20px;} 
		.question-tab-header h3 span {color: #999;}
		.question-tab-header .question-tabs {float: right;}
		.question-tab-sort > a {margin-right:10px;cursor: pointer; vertical-align:middle; font-size: 14px; text-transform: uppercase;}
		.question-tab-sort > a:hover {color: #212121;}
		.question-tab-sort .sortSelected {font-weight: 600;}
		.question-tab-content {padding: 30px 10px;}
		.list-questions{padding-left: 0;}
		.questions-related {line-height: 1.3;font-size: 12px;}
		.related-item {display: flex; margin-bottom: 12px;}
		.related-item a:first-child {padding-right: 10px;}
		.related-item a {color: #008ad6;}
		.related-item .answer-votes {padding: 3px 0;
    	white-space: nowrap; width: 38px; text-align: center; box-sizing: border-box; height: auto; float: none; border-radius: 2px; font-size: 90%; color: #3b4045; transform: translateY(-1px);} 
    </style>
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	<div class="row ">
		<div class="col s12 search-form" ng-hide="tab === 0">
            <input placeholder="Tìm kiếm câu hỏi" type="text" ng-model="keywords" ng-change="search()" class="form-control" required>
        </div>
	</div>
	@verbatim
		<div ng-init="getQuestionsWithTab(1)"></div>
		<div class="row justify-content-md-center" id="top">
			<div class="col s12 tab-bar">
				<div class="question-tab-header full-tab-header">
					Tất cả câu hỏi  <span class="info-dark-text"> ({{total}})</span>
					<div class="question-tabs question-tab-sort">
						<a ng-class="{sortSelected:tab === 1}" href ="/questions/">mới</a>
						<a ng-class="{sortSelected:tab === 2}" href="/questions/?filter=hot">nổi bật</a>
						<a ng-class="{sortSelected:tab === 3}" href="/questions/?filter=hotinweek">nổi bật tuần</a>
						<a ng-class="{sortSelected:tab === 7}" href="/questions/?filter=notresolve">chưa giải quyết</a>
						<a ng-class="{sortSelected:tab === 8}" href="/questions/?filter=nothaveanswer">chưa có trả lời </a>
					</div>
				</div>
			</div>
			<div class="col s12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>	
		</div>	
		<div class="row" ng-show="totalPages!=1 && isLoaded == 1">
			<div class="col-12">
				<posts-paginations class="text-center"></posts-paginations>
			</div>
		</div>
	@endverbatim
@endsection
