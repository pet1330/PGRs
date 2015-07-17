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
            {!! Form::select('gs_form_id', $gsFormsList, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group @if ($errors->has('submitted_at')) has-error @endif">
            {!! Form::label('Submitted date & time') !!}
            <div class='input-group date' id='submittedAtDatetimePicker'>
                {!! Form::input('datetime', 'submitted_at', date('Y-m-d G-i-s'), ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('submitted_at')) <p class="help-block">{{ $errors->first('submitted_at') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('approved_at')) has-error @endif">
            {!! Form::label('Approved date & time') !!}
            <div class='input-group date' id='approvedAtDatetimePicker'>
                {!! Form::text('approved_at', null, ['class' => 'form-control', 'id' => 'approved_at']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="clearApprovedAt();">Clear</button>
                </span>
            </div>
            @if ($errors->has('approved_at')) <p class="help-block">{{ $errors->first('approved_at') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Director of study') !!}
            {!! Form::select('director_of_study_id', $staffList, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Second supervisor') !!}
            {!! Form::select('second_supervisor_id', ['' => ''] + $staffList, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Third supervisor') !!}
            {!! Form::select('third_supervisor_id', ['' => ''] + $staffList, null, ['class' => 'form-control select2_enabled']) !!}
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
        $('#submittedAtDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#approvedAtDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
    });
    function clearApprovedAt()  
    {
        approved_at.value = "";
        document.getElementById("approved_at").blur();
    }
</script>
@endsection
@stop