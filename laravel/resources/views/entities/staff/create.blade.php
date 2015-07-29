@extends(Auth::user()->default_layout)
@section('title')
Create a new staff member
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'StaffController@store']) !!}
    <fieldset>
        <div class="form-group @if ($errors->has('title')) has-error @endif">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('first_name')) has-error @endif">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('middle_name')) has-error @endif">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('middle_name')) <p class="help-block">{{ $errors->first('middle_name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('last_name')) has-error @endif">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('userImage')) has-error @endif">
            {!! Form::label('Profile image') !!}
            {!! Form::file('userImage', null, ['class'=>'form-control']) !!}
            @if ($errors->has('userImage')) <p class="help-block">{{ $errors->first('userImage') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('email')) has-error @endif">
            {!! Form::label('Account email') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_email')) has-error @endif">
            {!! Form::label('Personal/other email') !!}
            {!! Form::email('personal_email', null, ['class' => 'form-control']) !!}
            @if ($errors->has('personal_email')) <p class="help-block">{{ $errors->first('personal_email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_phone')) has-error @endif">
            {!! Form::label('University phone number') !!}
            {!! Form::text('university_phone', null, ['class' => 'form-control']) !!}
            @if ($errors->has('university_phone')) <p class="help-block">{{ $errors->first('university_phone') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_phone')) has-error @endif">
            {!! Form::label('Personal phone number') !!}
            {!! Form::text('personal_phone', null, ['class' => 'form-control']) !!}
            @if ($errors->has('personal_phone')) <p class="help-block">{{ $errors->first('peronal_phone') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('position')) has-error @endif">
            {!! Form::label('Position') !!}
            {!! Form::text('position', null, ['class' => 'form-control']) !!}
            @if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('room')) has-error @endif">
            {!! Form::label('Room') !!}
            {!! Form::text('room', null, ['class' => 'form-control']) !!}
            @if ($errors->has('room')) <p class="help-block">{{ $errors->first('room') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('about')) has-error @endif">
            {!! Form::label('About') !!}
            {!! Form::textarea('about', null, ['class' => 'form-control']) !!}
            @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('permissions')) has-error @endif">
            {!! Form::label('Roles') !!}
            {!! Form::select('roles[]', $all_roles, null, ['multiple' => true, 'class' => 'form-control  select2_enabled']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Disable account login') !!}
            {!! Form::checkbox('locked', '1', '0') !!}
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