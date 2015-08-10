@extends(Auth::user()->default_layout)
@section('title')
Import Data
@endsection
@section('content')
@include('global.includes.show_alerts')
@include('global.includes.show_errors')
<div class="panel panel-default">
	<div class="panel-heading">
		Import new students
	</div>
	<div class="panel-body">
		<p>This is for adding a batch of new students to the system from a CSV file.</p>
		<div class="well">
			<h4>How you should format your CSV file</h4>
			<p>If you do not format your file correctly this won't work. You MUST get the formatting exactly correct or the import will fail.</p>
			<p>The following list details all the fields for a new student. Not every field is required but must be included in your CSV file. For example if a student does not have a middle name then it can be left blank but you file must include the ,, denoting the field as blank.</p>
			<ul>
				<li>Student ID (Required) <i>Must be AAA12345678 format</i></li>
				<li>Title</li>
				<li>First name (Required)</li>
				<li>Middle name</li>
				<li>Last name (Required)</li>
				<li>Email address (Required) <i>This must be unique in the system</i></li>
				<li>Personal email address</li>
				<li>Personal phone number</li>
				<li>Password</li>
				<li>Account login locked? <i>Enter 'YES' to lock account login</i></li>
				<li>Date of birth</li>
				<li>Gender <i>'Male', 'Female' and 'Other' excepted</i></li>
				<li>Home address (Required)</li>
				<li>Current address</li>
				<li>Nationality (Required)</li>
				<li>Start date (Required)</li>
				<li>End date</li>
				<li>Award (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>Mode of study (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>Course (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>Enrolment status (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>Funding type (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>UK/BA status (Required) <i>This must be the <strong>exact</strong> name used in the system!</i></li>
				<li>Director of study email <i>This is the existing staff member's email address in this system. The supervision record's start date will be automatically set to the student's start date.</i></li>
				<li>Second supervisor email <i>This is the existing staff member's email address in this system. The supervision record's start date will be automatically set to the student's start date.</i></li>
				<li>Third supervisor email <i>This is the existing staff member's email address in this system. The supervision record's start date will be automatically set to the student's start date.</i></li>
			</ul>
		</div>
		{!! Form::open(['action' => 'StudentsController@importNew', 'files' => true]) !!}
		<fieldset>
			<div class="form-group required @if ($errors->has('csvFile')) has-error @endif">
				{!! Form::label('CSV file') !!}
				{!! Form::file('csvFile', null, ['class'=>'form-control']) !!}
				@if ($errors->has('csvFile')) <p class="help-block">{{ $errors->first('csvFile') }}</p> @endif
			</div>
			<div class="form-group">
				{!! Form::label('Auto generate default events for new students') !!}
				{!! Form::checkbox('autoGenerateEnabled', 1, true) !!}
			</div>
			<div class="alert alert-info">
				<p>Once you press Import, please be patient. There's some magic going on here that can take a few minutes to do it's thing.</p>
				<p><strong>Do not press the Import button more than once or leave the page!</strong></p>
			</div>
			<div class="btn-group">
				{!! Form::submit('Import', ['class' => 'btn btn-primary']) !!}
			</div>
		</fieldset>
		{!! Form::close() !!}
	</div>
</div>
@endsection
@stop