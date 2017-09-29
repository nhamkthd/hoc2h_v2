@extends('users.layouts')
@section('user_content')
	<div class="row">
		<div class="col-md-12 col-sm-12">
			@foreach($users as $user)
				<p>{{$user->name}} - <span>{{$user->class}}</span> - <span>{{$user->birthday}}</span></p>
			@endforeach
		</div>
	</div>
@endsection