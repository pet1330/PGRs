@extends(Auth::user()->default_layout)
@section('title')
Edit: {{ $staff->user->full_name}}
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::model($staff, ['method' => 'PATCH', 'files' => true, 'action' => array('StaffController@update', 'id' => $staff->id)]) !!}
    <fieldset>
        <div class="form-group @if ($errors->has('title')) has-error @endif">
            {!! Form::label('Title') !!}
            {!! Form::text('title', $staff->user->title, ['class' => 'form-control', 'placeholder' => 'Mr']) !!}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('first_name')) has-error @endif">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', $staff->user->first_name, ['class' => 'form-control', 'placeholder' => 'Jeffrey']) !!}
            @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('middle_name')) has-error @endif">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', $staff->user->middle_name, ['class' => 'form-control', 'placeholder' => 'Lynn']) !!}
            @if ($errors->has('middle_name')) <p class="help-block">{{ $errors->first('middle_name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('last_name')) has-error @endif">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', $staff->user->last_name, ['class' => 'form-control', 'placeholder' => 'Goldblum']) !!}
            @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
        </div>
        @if ($staff->user->image != NULL)
        <div class="form-group">
            {!! Form::label('Change existing profile image') !!}
            {!! Form::file('userImage', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Remove existing profile image') !!}
            {!! Form::checkbox('removeUserImage', '1') !!}
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Profile image') !!}
            {!! Form::file('userImage', null, ['class'=>'form-control']) !!}
        </div>
        @endif
        <div class="form-group required @if ($errors->has('email')) has-error @endif">
            {!! Form::label('Account email') !!}
            {!! Form::email('email', $staff->user->email, ['class' => 'form-control', 'placeholder' => 'jgoldblum@lincoln.ac.uk']) !!}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_email')) has-error @endif">
            {!! Form::label('Personal/other email') !!}
            {!! Form::email('personal_email', $staff->user->personal_email, ['class' => 'form-control', 'placeholder' => 'ian.malcolm@jurassicsystems.com']) !!}
            @if ($errors->has('personal_email')) <p class="help-block">{{ $errors->first('personal_email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_phone')) has-error @endif">
            {!! Form::label('University phone number') !!}
            {!! Form::text('university_phone', $staff->university_phone, ['class' => 'form-control', 'placeholder' => '01522 83 7374']) !!}
            @if ($errors->has('university_phone')) <p class="help-block">{{ $errors->first('university_phone') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_phone')) has-error @endif">
            {!! Form::label('Personal phone number') !!}
            {!! Form::text('personal_phone', $staff->user->personal_phone, ['class' => 'form-control', 'placeholder' => '07898765432']) !!}
            @if ($errors->has('personal_phone')) <p class="help-block">{{ $errors->first('peronal_phone') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('position')) has-error @endif">
            {!! Form::label('Position') !!}
            {!! Form::text('position', $staff->position, ['class' => 'form-control', 'placeholder' => 'Lecturer']) !!}
            @if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('room')) has-error @endif">
            {!! Form::label('Room') !!}
            {!! Form::text('room', $staff->room, ['class' => 'form-control', 'placeholder' => 'MC2101']) !!}
            @if ($errors->has('room')) <p class="help-block">{{ $errors->first('room') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('about')) has-error @endif">
            {!! Form::label('About') !!}
            {!! Form::textarea('about', $staff->about, ['class' => 'form-control']) !!}
            @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Disable account login') !!}
            {!! Form::checkbox('locked', '1', $staff->user->locked) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StaffController@show', ['id' => $staff->id]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update staff', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop