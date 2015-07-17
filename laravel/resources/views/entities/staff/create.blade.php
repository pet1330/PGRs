@extends(Auth::user()->default_layout)
@section('title')
Create a new staff member
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'StaffController@store']) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Personal email') !!}
            {!! Form::email('personal_email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('University phone') !!}
            {!! Form::text('university_phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Personal phone') !!}
            {!! Form::text('personal_phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Position') !!}
            {!! Form::text('position', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Room') !!}
            {!! Form::text('room', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('About') !!}
            {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StaffController@index') }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add new staff member', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop