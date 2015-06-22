@extends('staff.layouts.default')
@section('title')
Create a new student
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    {!! Form::open(['action' => 'StudentsController@store']) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Mr']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Jeffrey']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => 'Lynn']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Goldblum']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Student ID number') !!}
            {!! Form::text('enrolment', null, ['class' => 'form-control', 'placeholder' => 'GOL12345678']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Account email') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'GOL12345678@students.lincoln.ac.uk']) !!}
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
        <div class="form-group">
            {!! Form::label('Home address') !!}
            {!! Form::textarea('home_address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Current address') !!}
            {!! Form::textarea('current_address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Nationality') !!}
            {!! Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => 'American']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Start date') !!}
            {!! Form::input('date', 'start', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>
        <div class="alert alert-info">This student's predicted end date will be automatically calculated once they have been added to the system.</div>
        <div class="form-group">
            {!! Form::submit('Add student', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop