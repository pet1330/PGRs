@extends('staff.layouts.default')
@section('title')
Edit {{ $event->gs_form->name }} for {{ $event->student->user->full_name }} <small>{{ $event->student->enrolment }}</small>
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::model($event, ['method' => 'PATCH', 'action' => array('EventsController@update', 'enrolment' => $event->student->enrolment, 'id' => $event->id)]) !!}
    <fieldset>
        <div class="form-group @if ($errors->has('submitted_at')) has-error @endif">
            {!! Form::label('Submitted date & time') !!}
            <div class='input-group date' id='submittedAtDatetimePicker'>
                {!! Form::text('submitted_at', $event->submitted_at, ['class' => 'form-control', 'id' => 'submitted_at']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="clearSubmittedAt();">Clear</button>
                </span>
            </div>
            @if ($errors->has('submitted_at')) <p class="help-block">{{ $errors->first('submitted_at') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('approved_at')) has-error @endif">
            {!! Form::label('Approved date & time') !!}
            <div class='input-group date' id='approvedAtDatetimePicker'>
                {!! Form::text('approved_at', $event->approved_at, ['class' => 'form-control', 'id' => 'approved_at']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="clearApprovedAt();">Clear</button>
                </span>
            </div>
            @if ($errors->has('approved_at')) <p class="help-block">{{ $errors->first('approved_at') }}</p> @endif
        </div>
        @if ($event->gs_form->defaultDuration || $event->gs_form->defaultStartMonth)
        <div class="well">
            <h4>Override automatic event start and end dates</h4>
            <div class="alert alert-info">
                <p>If the following checkbox is selected then the dates you enter for the expected start and end date <strong>will be stored</strong>, overriding automatically calculated dates.</p>
            </div>
            <div class="form-group">
                {!! Form::label('Enable start and end date override') !!}
                {!! Form::checkbox('auto_calculate_disabled', 1) !!}
            </div>
            <div class="form-group @if ($errors->has('exp_start')) has-error @endif">
                {!! Form::label('Expected start') !!}
                <div class='input-group date' id='expStartDatetimePicker'>
                    {!! Form::text('exp_start', $event->exp_start, ['class' => 'form-control', 'id' => 'exp_start']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="clearExpStart();">Clear</button>
                    </span>
                </div>
                @if ($errors->has('exp_start')) <p class="help-block">{{ $errors->first('exp_start') }}</p> @endif
            </div>
            <div class="form-group @if ($errors->has('exp_end')) has-error @endif">
                {!! Form::label('Expected end') !!}
                <div class='input-group date' id='expEndDatetimePicker'>
                    {!! Form::text('exp_end', $event->exp_end, ['class' => 'form-control', 'id' => 'exp_end']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="clearExpEnd();">Clear</button>
                    </span>
                </div>
                @if ($errors->has('exp_end')) <p class="help-block">{{ $errors->first('exp_end') }}</p> @endif
            </div>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', $event->comments, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Director of study') !!}
            {!! Form::select('director_of_study_id', $staffList, $event->directorOfStudy->id, ['class' => 'form-control select2_enabled']) !!}
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
            <a class="btn btn-default" href="{{ action('EventsController@show', ['enrolment' => $event->student->enrolment, 'id' => $event->id]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update event', ['class' => 'btn btn-primary']) !!}
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
        $('#expStartDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#expEndDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
    function clearSubmittedAt()  
    {
        submitted_at.value = "";
        document.getElementById("submitted_at").blur();
    }
    function clearApprovedAt()  
    {
        approved_at.value = "";
        document.getElementById("approved_at").blur();
    }
    function clearExpStart()  
    {
        exp_start.value = "";
        document.getElementById("exp_start").blur();
    }
    function clearExpEnd()  
    {
        exp_end.value = "";
        document.getElementById("exp_end").blur();
    }
</script>
@endsection
@stop