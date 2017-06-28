@extends('layouts.app')
@section('content')
<style type="text/css">
	table{border:solid 1px green;}
	table >tr >td,th {padding: 10px;}
</style>
<div class="container" ng-app="hoc2h-quuestion" ng-controller="QuestionController as mCtrl">
    <div class="row">
        <div class="col-md-12" style="height:800px;">
        	<input type="text" name="" ng-model="x">
        	<input type="text" name="" ng-model="y">
        	<p>sum = @{{total}}</p>
			<table >
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
				</tr>
				<tr ng-repeat="user in users">
					<td>@{{user.name}}</td>
					<td>@{{user.email}}</td>
					<td>@{{user.phone}}</td>
				</tr>
			</table>
        </div>
    </div>
</div>
@endsection
