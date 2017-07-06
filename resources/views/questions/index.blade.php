@extends('questions.layout')
@section('question_content')
	<style type="text/css">
		table {
		    font-family: arial, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		}
		th {
			border-bottom: solid 3px #ddd ;
		}
		td {
		    border-bottom: 1px solid #dddddd;
		    text-align: left;
		    padding: 8px;
		}
		a.table-link{
			color:#3F729B;
			font-size: 16px;
			font-weight: 400;
		}
		a.table-link:hover{color:#2BBBAD;}

	</style>
	@verbatim
		{{setSelectedTab(1)}}	
	@endverbatim
	<div class="row">
		<div class="col-md-12 filter-action">

		</div>
		<div class="col-md-12 list-questions">
			<div class="table-users">
			   <div class="header text-center"> </div>
			   <table cellspacing="0">
			      	<tr>
			         	<th width="60%">Câu hỏi</th>
			         	<th>Đăng bởi</th>
			         	<th>Thể loại</th>
			         	<th>Thống kê</th>
			         	<th>Thơi gian</th>
			      	</tr>
			      	@foreach($questions as $question)
				     	<tr>
				     		<td><a href="{{url('/questions/question/'.$question->id)}}" class="table-link">{{$question->title}}</a></td>
				      		<td><a href="">Aries1992</a></td>
				         	<td>Kien thuc THPT</td>
				         	<td></td>
				         	<td>{{$question->created_at}}</td>
				     	 </tr>
			     	 @endforeach
			   </table>
			</div>
		</div>
	</div>
@endsection
