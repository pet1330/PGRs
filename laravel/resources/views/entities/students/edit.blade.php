@extends(Auth::user()->default_layout)
@section('title')
Edit: {{ $student->user->full_name}}
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::model($student, ['method' => 'PATCH', 'files' => true, 'action' => array('StudentsController@update', 'student_id' => $student->id)]) !!}
    <fieldset>
        <div class="form-group @if ($errors->has('title')) has-error @endif">
            {!! Form::label('Title') !!}
            {!! Form::text('title', $student->user->title, ['class' => 'form-control', 'placeholder' => 'Mr']) !!}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('first_name')) has-error @endif">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', $student->user->first_name, ['class' => 'form-control', 'placeholder' => 'Jeffrey']) !!}
            @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('middle_name')) has-error @endif">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', $student->user->middle_name, ['class' => 'form-control', 'placeholder' => 'Lynn']) !!}
            @if ($errors->has('middle_name')) <p class="help-block">{{ $errors->first('middle_name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('last_name')) has-error @endif">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', $student->user->last_name, ['class' => 'form-control', 'placeholder' => 'Goldblum']) !!}
            @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('enrolment')) has-error @endif">
            {!! Form::label('Enrolment number') !!}
            {!! Form::text('enrolment', null, ['class' => 'form-control', 'placeholder' => 'GOL12345678', 'maxlength' => '11', 'pattern' => '[A-Z]{3}[0-9]{8}']) !!}
            @if ($errors->has('enrolment')) <p class="help-block">{{ $errors->first('enrolment') }}</p> @endif
        </div>
        @if ($student->user->image != NULL)
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
            {!! Form::email('email', $student->user->email, ['class' => 'form-control', 'placeholder' => '12345678@students.lincoln.ac.uk']) !!}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_email')) has-error @endif">
            {!! Form::label('Personal/other email') !!}
            {!! Form::email('personal_email', $student->user->personal_email, ['class' => 'form-control', 'placeholder' => 'ian.malcolm@jurassicsystems.com']) !!}
            @if ($errors->has('personal_email')) <p class="help-block">{{ $errors->first('personal_email') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('personal_phone')) has-error @endif">
            {!! Form::label('Phone number') !!}
            {!! Form::text('personal_phone', $student->user->personal_phone, ['class' => 'form-control', 'placeholder' => '07898765432']) !!}
            @if ($errors->has('personal_phone')) <p class="help-block">{{ $errors->first('peronal_phone') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('gender')) has-error @endif">
            {!! Form::label('Gender') !!}
            {!! Form::text('gender', null, ['class' => 'form-control', 'placeholder' => 'Male']) !!}
            @if ($errors->has('gender')) <p class="help-block">{{ $errors->first('gender') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('home_address')) has-error @endif">
            {!! Form::label('Home address') !!}
            {!! Form::textarea('home_address', null, ['class' => 'form-control']) !!}
            @if ($errors->has('home_address')) <p class="help-block">{{ $errors->first('home_address') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('current_address')) has-error @endif">
            {!! Form::label('Current address') !!}
            {!! Form::textarea('current_address', null, ['class' => 'form-control']) !!}
            @if ($errors->has('current_address')) <p class="help-block">{{ $errors->first('current_address') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('nationality')) has-error @endif">
            {!! Form::label('Nationality') !!}
            {!! Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => 'British']) !!}
            @if ($errors->has('nationality')) <p class="help-block">{{ $errors->first('nationality') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date') !!}
            <div class='input-group date' id='startDatetimePicker'>
                {!! Form::text('start', $student->start, ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('end')) has-error @endif">
            {!! Form::label('End date') !!}
            <div class='input-group date' id='endDatetimePicker'>
                {!! Form::text('end', $student->end, ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
        </div>
        <div class="form-group required">
            {!! Form::label('UKBA status') !!}
            {!! Form::select('ukba_status_id', $ukba_status, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Funding') !!}
            {!! Form::select('funding_type_id', $funding_types, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Award') !!}
            {!! Form::select('award_id', $awards, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Mode of Study') !!}
            {!! Form::select('mode_of_study_id', $modes_of_study, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Enrolment Status') !!}
            {!! Form::select('enrolment_status_id', $enrolment_statuses, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Disable student login') !!}
            {!! Form::checkbox('locked', '1', $student->user->locked) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update student', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $(function () {
        $('#startDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#endDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
</script>
@endsection
@stop