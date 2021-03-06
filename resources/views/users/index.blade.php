<style>
	input[type=file] {position: absolute; top: 0; right: 0; min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; filter: alpha(opacity=0); opacity: 0; outline: none; background: white; cursor: inherit; display: block;} 
	.list-unstyled { list-style: none;margin-left: 0;}
	.tab-bar {padding:0px;}
	.tab-bar ul {list-style-type: none; margin: 0; padding: 0; overflow: hidden; background-color:#fff; border-bottom: 1px solid #e4e6e8; } 
	.tab-bar li {float: left; margin-right:5px;}
	.tab-bar li a {display: block; color:#607d8b; text-align: center; padding: 14px 16px; text-decoration: none; }
	.tab-bar li:hover:not(.selected) a {color: #455a64 ; border-bottom: solid 2px #3F729B; } 
	.tab-bar li.selected a{color:#2BBBAD; border-bottom: solid 2px #2BBBAD;} 

	.sub-tab-header {margin-bottom: 15px; clear: both;height: 40px; border-bottom: 1px solid #e4e6e8;}
	.sub-tab-header h3 {float: left; margin-bottom: 0px; font-weight: normal; font-size:18px; margin-bottom: 20px;} 
	.sub-tab-header h3 span {color: #999;}
	.sub-tab-header .sub-tabs {float: right;}
	.sub-tab-sort > span {margin-right: 10px; color: rgb(106, 115, 124);cursor: pointer; padding-bottom: 10px;}
	.sub-tab-sort > span:hover {color: #212121; border-bottom: 1px solid #3F729B;}
	.sub-tab-sort .sortSelected {color: #1C2331; border-bottom: 1px solid #3F729B;font-weight: 600;}
	.tab-content {padding: 30px 10px;}

	.side-info {}
	.avt-card {border: 1px solid #c8ccd0;border-radius:2px; text-align:center;}
	.avt-card .avatar {width: 164px; height: 164px; overflow: hidden; margin: auto; margin-top:40px;}
	.avt-card .coin-info {padding: 12px 0;font-size: 22px;font-weight: 300;color: #181a1c;}
	.avt-card .coin-info .label-uppercase {vertical-align: middle;}
	.label-uppercase {text-transform: uppercase;font-size: 11px;font-weight: 500;color: #999;}
	.avt-card .actions {padding: 10px; color: #3F729B; margin-bottom:30px;}
	.avt-card .actions span {margin-left: 10px; padding: 5px 10px; border:solid 1px #e0e1e3; border-radius:2px; cursor: pointer;}
	.avt-card .actions span:first-child {margin-left:0;}
	.avt-card .actions span:hover {color: #0d47a1;}
	
	.main-info {padding-left: 20px;}
	.main-info .about {height: 278px; overflow-y: auto; overflow-x: hidden; padding-right: 20px; margin-right: 20px; max-width: 63%; }
	h3.author-name  {margin-top: 0px;}
	.user-description {font-size: 15px; line-height: 20px; padding-right: 20px;}
	.main-info .user-contact {color: #6a737c;position: relative;}
	.user-status .number {display: block; color: #0C0D0E; font-weight: 700; font-size: 17px;color: #FF8800;} 
	.contact-info {margin-top: 20px;}
	.contact-list {list-style: none;margin-left: 0;}
	.contact-list li {padding-top: 10px;}
	.contact-list i {font-size: 17px; margin-right: 10px;}

	.summary{margin-top: 20px;}
	h3.title-section {font-weight: 600; margin-bottom: 16px; border-bottom: 1px solid #e4e6e8; padding-bottom: 10px; font-size: 15px; color:#FF8800;}
	h3.title-section span {color: #999; font-weight: 300;}
	#summary-table {border-spacing: 0;border-collapse: collapse; width: 100%;}
	td.summary-wrapper {width: 33.3%; vertical-align: top; } 
	.summary-wrapper:first-child {padding-left: 0;border-left: none;}
	.summary-wrapper{border-left: 1px solid #e4e6e8;padding: 0 15px;}
	.summary-number {display: block; margin-bottom: 20px; text-align: center; padding: 7px;background-color:#e0f2f1; border-color: #ece3c8;} 
	.summary-number .name {text-transform: uppercase; color: #999; font-size: 11px; font-weight: 700;}
    .summary-number .number {font-size: 24px; display: block; margin: 6px 0 4px 0; }
    .summary-detail h5 {margin:10px 0; font-size: 13px; display: block;}
 	.detail-list {margin-bottom: 0;}
    .detail-list li {margin-bottom: 6px; font-size: 13px;}
    .detail-list li i {color: #FF8800; font-size: 9px; margin-right:5px;}
    .detail-list li span { color: #0099CC; float: right;}

    #side-menu {margin:16px 0 0;}
    #side-menu ul li.category {color: #0099CC; text-transform: uppercase; font-size: 12px; padding-bottom:20px;}
    #side-menu ul ul {margin-top:8px; }
    #side-menu ul ul li {position: relative;display: block; text-transform:none;margin-bottom:10px;}
    #side-menu ul ul li > a {padding-left: 0px; color:#848d95; font-size:13px;}
    #side-menu ul ul li > a:hover:not(.active) {color:#4B515D;}
    #side-menu ul ul li > a.active {color:#242729;font-weight:bold;}
    .edit-profile .avatar-wrapper {position: relative; width: 164px; height: 164px; overflow: hidden;}
    .avatar-wrapper #change-avtar {position: absolute; bottom: 0; left: 0; right: 0; background: rgba(12,13,14,0.6); border: 0; border-radius: 0 0 3px 3px; color: #FFF; text-align: center; padding: 8px 0; width: auto; transition: background .3s ease; }
    
    .edit-profile {border-bottom: 1px solid #eaeaea; padding: 0 10px 20px 10px;}
	.form-info span { font-weight: bold; font-size: 12px;}
	.gender-radio label {margin-right: 10px;font-weight: normal;}
	.btn.btn-default.btn-sm {font-size: 0.2rem;padding: 5px;box-shadow: none;color:#4d545d;}
	
	.private-setting {padding:15px;}
	.setting-table {width: 100%; margin-bottom:20px;}
	.setting-table tr:not(last-child) td {border-bottom: 1px solid #eff0f1;}
	.setting-table td { padding:18px; vertical-align: middle; font-size: 13px;}
	.setting-table td .desc {line-height: 1.13333333;}
	.setting-table td strong {display: block;font-size: 14px;color: #242729;position: relative;padding-bottom:5px;}
	.setting-table td .action {padding-right:22px; text-align:right;}
	.TriSea-technologies-Switch > input[type="checkbox"] {display: none;}
	.TriSea-technologies-Switch > label {cursor: pointer; height: 0px; position: relative; width: 40px; }
	.TriSea-technologies-Switch > label::before {background: rgb(0, 0, 0); box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5); border-radius: 8px; content: ''; height: 16px; margin-top: -8px; position:absolute; opacity: 0.3; transition: all 0.4s ease-in-out; width: 40px; } 
	.TriSea-technologies-Switch > label::after {background: rgb(255, 255, 255); border-radius: 16px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3); content: ''; height: 24px; left: -4px; margin-top: -8px; position: absolute; top: -4px; transition: all 0.3s ease-in-out; width: 24px; }
	.TriSea-technologies-Switch > input[type="checkbox"]:checked + label::before {background: inherit; opacity: 0.5; }
	.TriSea-technologies-Switch > input[type="checkbox"]:checked + label::after {background: inherit; left: 20px; }
	.TriSea-technologies-Switch span {margin-right: 18px;}

	.user-panel {float: left; margin-bottom: 30px; margin-top: 20px;}
	.user-panel .panel-content {margin-bottom: 10px; padding-top:5px;}
	.panel-content-table {border-collapse: collapse;border-spacing: 0; width: 100%; overflow: auto;}
	.panel-content-table td {padding: 4px 0;vertical-align: top;}
	.panel-content-table td.count-cell {width:30px;}
	.mini-counts {font-size: 12px; font-weight: normal; line-height: 1.3; text-align: center; color: #6a737c; min-width: 36px; height: auto; padding: 3px 6px; margin-right: 10px; display: inline-block; border: 1px solid #b9b9b9; border-radius: 2px; }
	.active-panel-footer {margin-top: 15px;}
	.active-panel-footer a {font-weight: 300; font-size: 13px;}

	.sub-tab-content {vertical-align: baseline;font: inherit; padding: 10px 0;}
	.user-questions {overflow: auto;}
	.question-summary {padding: 5px 0; float: none; border-bottom: 1px solid #eff0f1; width:auto;overflow: hidden;box-sizing: content-box;}
	.question-counts .cp {float: left;vertical-align: top; margin-right: 10px; cursor: pointer;}
	.narrow .mini-counts  {font-size: 15px; font-weight: 300; color: #6a737c; margin: 0 0 5px 0; border:none;}
	.couts-detail {display: inline-block; min-width: 44px; height: auto; font-size: 11px; padding: 6px;text-align: center;}
	.question-summary-detail {margin-bottom:0;}
	.created_date {float:right;font-size: 12px; color: #9199a1;}

	.answer-summary {padding: 5px 0; float: left; border-bottom: 1px solid #eff0f1; width: 100%;}
	.answer-votes {font-size: 12px; font-weight: normal; line-height: 1.3; text-align: center; color: #6a737c; min-width: 36px; height: auto; padding: 3px 6px;  border: 1px solid #b9b9b9; border-radius: 2px;}
	.answer-link {padding: 0;  padding-left: 10px; color: #535a60;}
	.answer-link .title-hyperlink {width:85%;}
</style>
@extends('users.layouts')
@section('user_content')
	<div ng-init="getUser({{$user_id}},{{$currentTab}})"></div>
	<div class="col-md-12 tab-bar">
		<ul>
		  <li ng-class="{selected:currentTab === 1}"><a href="{{url('/users/'.$user_id.'/profile')}}">Thông tin chung</a></li>
		  <li ng-class="{selected:currentTab === 2}"><a href="{{url('/users/'.$user_id.'/activity')}}">Hoạt động</a></li>
		  <li ng-show="{{$user_id}} == {{Auth::user()->id}}" ng-class="{selected:currentTab === 3}"><a href="{{url('/users/'.$user_id.'/setting')}}">Cài đặt</a></li>
		</ul>
	</div>
		<div ng-show="currentTab === 1">
			@include('users.directives.profile_directive')
		</div>

		<div ng-show="currentTab === 2">
			@include('users.directives.activity_directive')
		</div>

		<div ng-show="currentTab === 3">
			@include('users.directives.setting_directive')
		</div>
@endsection