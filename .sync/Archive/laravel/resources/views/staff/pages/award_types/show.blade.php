@extends('staff.layouts.default')
@section('title')
{{ $award_type->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 
	<table class="table table-user-information">
		<tbody>
			<tr>
				<td>Name</td>
				<td>{{ $award_type->name }}</td>
			</tr>
			<tr>
				<td>Number of students on this award</td>
				<td>{{ $result = App\Student::AwardType($award_type->id)->count() }}</td>
			</tr>
		</tr>
	</tbody>
</table>
<div class="btn-group">
	<a class="btn btn-default" href="{{ action('AwardTypeController@edit', ['name' => $award_type->name]) }}">Edit</a>
</div>
<div class="btn-group">
	<form action="{{ action('AwardTypeController@destroy', ['name' => $award_type->name]) }}" method="POST">
		<input type="hidden" name="_method" value="DELETE">
		<button class="btn btn-danger" type="submit">Delete</button>
	</form>
</div>
</div>
@endsection
@stop