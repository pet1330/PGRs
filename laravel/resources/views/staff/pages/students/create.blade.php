@extends('staff.layouts.default')
@section('title')
Create a new student
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'StudentsController@store', 'files' => true]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Mr']) !!}
        </div>
        <div class="form-group required @if ($errors->has('first_name')) has-error @endif">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jeffrey']) !!}
            @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Lynn']) !!}
        </div>
        <div class="form-group required  @if ($errors->has('last_name')) has-error @endif">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Goldblum']) !!}
            @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('enrolment')) has-error @endif">
            {!! Form::label('Enrolment number') !!}
            {!! Form::text('enrolment', null, ['class' => 'form-control', 'placeholder' => 'GOL12345678', 'maxlength' => '11', 'pattern' => '[A-Z]{3}[0-9]{8}']) !!}
            @if ($errors->has('enrolment')) <p class="help-block">{{ $errors->first('enrolment') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Profile image') !!}
            {!! Form::file('userImage', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('email')) has-error @endif">
            {!! Form::label('Account email') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => '12345678@students.lincoln.ac.uk']) !!}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Personal/other email') !!}
            {!! Form::email('personal_email', null, ['class' => 'form-control', 'placeholder' => 'ian.malcolm@jurassicsystems.com']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Phone number') !!}
            {!! Form::text('personal_phone', null, ['class' => 'form-control', 'placeholder' => '07898765432']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Gender') !!}
            {!! Form::text('gender', null, ['class' => 'form-control', 'placeholder' => 'Male']) !!}
        </div>
        <div class="form-group required @if ($errors->has('home_address')) has-error @endif">
            {!! Form::label('Home address') !!}
            {!! Form::textarea('home_address', null, ['class' => 'form-control']) !!}
            @if ($errors->has('home_address')) <p class="help-block">{{ $errors->first('home_address') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Current address') !!}
            {!! Form::textarea('current_address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('nationality')) has-error @endif">
            {!! Form::label('Nationality') !!}
            {!! Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => 'British']) !!}
            @if ($errors->has('nationality')) <p class="help-block">{{ $errors->first('nationality') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date') !!}
            {!! Form::input('date', 'start', date('Y-m-d'), ['class' => 'form-control']) !!}
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="alert alert-info">The student's predicted end date will be automatically calculated once they have been added to the system.</div>
        <div class="form-group required">
            {!! Form::label('UKBA status') !!}
            {!! Form::select('ukba_status_id', $ukba_status, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Funding') !!}
            {!! Form::select('funding_type_id', $funding_types, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Course') !!}
            {!! Form::select('course_id', $courses, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Award') !!}
            {!! Form::select('award_id', $awards, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Mode of Study') !!}
            {!! Form::select('mode_of_study_id', $modes_of_study, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Enrolment Status') !!}
            {!! Form::select('enrolment_status_id', $enrolment_statuses, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Disable student login') !!}
            {!! Form::checkbox('locked', '1') !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add student', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop