@extends('staff.layouts.default')
@section('title', 'All Students')
@section('content')
	<div class="dataTable_wrapper">
		<table class="table table-striped table-bordered table-hover" id="all-students">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last Name</th>
                <th>Enrolment number</th>
                <th>Email</th>
                <th>Registered on</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $students)
				<tr>
		            <th>{{ $students->first_name }}</th>
		            <th>{{ $students->last_name }}</th>
		            <th><a href="{{ action('StudentsController@show', ['enrolment' => $students->student->enrolment]) }}">{{ $students->student->enrolment }}</a></th>
		            <th>{{ $students->email }}</th>
		            <th>{{ $students->created_at }}</th>
		        </tr>
		    @endforeach
        </tbody>
    	</table>
	</div>
	<!-- /.table-responsive -->
@endsection
@stop