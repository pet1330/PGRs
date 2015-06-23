@extends('staff.layouts.default')
@section('title')
{{ $funding->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
	<table class="table table-user-information">
		<tbody>
			<tr>
				<td>Name</td>
				<td>{{ $funding->name }}</td>
			</tr>
			<tr>
				<td>Comments</td>
				<td>{{ $funding->comments }}</td>
			</tr>
			<tr>
				<td>Number of students</td>
				<td>{{ $result = App\Student::FundingCount($funding->id)->count() }}</td>
			</tr>
		</tr>
	</tbody>
</table>
<div class="btn-group">
	<a class="btn btn-default" href="{{ action('FundingController@edit', ['name' => $funding->name]) }}">Edit</a>
</div>
<div class="btn-group">
	<form action="{{ action('FundingController@destroy', ['name' => $funding->name]) }}" method="POST">
		<input type="hidden" name="_method" value="DELETE">
		<button class="btn btn-danger" type="submit">Delete</button>
	</form>
</div>
</div>
@endsection
@stop