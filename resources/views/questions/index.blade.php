@extends('questions.layout')
@section('question_content')
	<style type="text/css">
		/*sort tab style*/
		.question-tab-header {margin-bottom: 13px; clear: both;height: 32px; border-bottom: 1px solid #e4e6e8;}
		.question-tab-header h3 {float: left; margin-bottom: 0px; font-weight: normal; font-size:18px; margin-bottom: 20px;} 
		.question-tab-header h3 span {color: #999;}
		.question-tab-header .question-tabs {float: right;}
		.question-tab-sort > a {margin-right: 10px; color: rgb(106, 115, 124);cursor: pointer; padding-bottom: 10px; font-size: 14px;}
		.question-tab-sort > a:hover {color: #212121; border-bottom: 2px solid #212121;}
		.question-tab-sort .sortSelected {color: #3F729B; border-bottom: 2px solid #3F729B;font-weight: 600;}
		.question-tab-content {padding: 30px 10px;}

		.questions-related {line-height: 1.3;font-size: 12px;}
		.related-item {display: flex; margin-bottom: 12px;}
		.related-item a:first-child {padding-right: 10px;}
		.related-item a {color: #008ad6;}
		.related-item .answer-votes {padding: 3px 0;
    	white-space: nowrap; width: 38px; text-align: center; box-sizing: border-box; height: auto; float: none; border-radius: 2px; font-size: 90%; color: #3b4045; transform: translateY(-1px);} 
    </style>
	<div ng-init="setSelectedTab({{$tabSelected}})"></div>
	@verbatim
		<div ng-init="getQuestionsWithTab(1)"></div>
		<div class="row" id="top">
			<div class="col-md-12" style="margin-top: 20px;">
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
			<div class="col-md-12 list-questions">
				<div ng-repeat="question in questions">
					<question-card></question-card>
				</div>
			</div>	
		</div>	
		<div class="row" ng-show="totalPages!=1 && isLoaded == 1">
			<div class="col-md-12">
				<posts-paginations class="text-center"></posts-paginations>
			</div>
		</div>
	@endverbatim
@endsection
