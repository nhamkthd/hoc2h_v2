@extends('layouts.app')
@section('content')
<style type="text/css">
	table{border:solid 1px green;}
	table >tr >td,th {padding: 10px;}
</style>
<div class="container" ng-app="hoc2h-quuestion" ng-controller="QuestionController as mCtrl">
	<md-sidenav
			class="md-sidenav-left"
			md-component-id="left"
			md-is-locked-open="$mdMedia('gt-md')"
			md-whiteframe="4">

		<md-toolbar class="md-theme-indigo">
			<h1 class="md-toolbar-tools">Sidenav Left</h1>
		</md-toolbar>
		<md-content layout-padding ng-controller="LeftCtrl">
			<md-button ng-click="close()" class="md-primary" hide-gt-md>
				Close Sidenav Left
			</md-button>
			<p hide show-gt-md>
				This sidenav is locked open on your device. To go back to the default behavior,
				narrow your display.
			</p>
		</md-content>

	</md-sidenav>
</div>
@endsection
