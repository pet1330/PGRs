@extends('staff.layouts.default')
@section('title')
Create a new event for {{ $student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => array('EventsController@store', 'enrolment' => $student->enrolment)]) !!}
    <fieldset>
        {!! Form::hidden('student_id', $student->id) !!}
        <div class="form-group required">
            {!! Form::label('GS form') !!}
            {!! Form::select('gs_form_id', $gsFormsList, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('submitted')) has-error @endif">
            {!! Form::label('Submitted date & time') !!}
            <div class='input-group date' id='submittedDatetimePicker'>
                {!! Form::input('datetime', 'submitted', date('Y-m-d G-i-s'), ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('submitted')) <p class="help-block">{{ $errors->first('submitted') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Director of study') !!}
            {!! Form::select('director_of_study_id', $staffList, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Second supervisor') !!}
            {!! Form::select('second_supervisor_id', ['' => ''] + $staffList, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Third supervisor') !!}
            {!! Form::select('third_supervisor_id', ['' => ''] + $staffList, null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add event', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $(function () {
        $('#submittedDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
    });
</script>
@endsection
@stop