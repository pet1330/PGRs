@extends(Auth::user()->default_layout)
@section('title')
Edit {{ $event->gs_form->name }} for {{ $event->student->user->full_name }} <small>{{ $event->student->enrolment }}</small>
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::model($event, ['method' => 'PATCH', 'action' => array('EventsController@update', 'enrolment' => $event->student->enrolment, 'id' => $event->id)]) !!}
    <fieldset>
        <div class="form-group required @if ($errors->has('created_at')) has-error @endif">
            {!! Form::label('Created date & time') !!}
            <div class='input-group date' id='createdAtDatetimePicker'>
                {!! Form::text('created_at', $event->created_at, ['class' => 'form-control', 'id' => 'created_at']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('created_at')) <p class="help-block">{{ $errors->first('created_at') }}</p> @endif
        </div>
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
        @if($event->gs_form->approved_enabled)
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
        @endif
        @if ($event->gs_form->defaultStartMonth)
        <div class="well">
            <h4>Change automatic event start and end dates</h4>
            <div class="alert alert-info">
                <p>This event features start and end dates that have been automatically generated when the event was initially created.</p>
                <p>You can however change them here to something other than the calculated default.</p>
            </div>
            <div class="form-group @if ($errors->has('start')) has-error @endif">
                {!! Form::label('Start') !!}
                <div class='input-group date' id='startDatetimePicker'>
                    {!! Form::text('start', $event->start, ['class' => 'form-control', 'id' => 'start']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="clearStart();">Clear</button>
                    </span>
                </div>
                @if ($errors->has('Start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
            </div>
            <div class="form-group @if ($errors->has('end')) has-error @endif">
                {!! Form::label('End') !!}
                <div class='input-group date' id='endDatetimePicker'>
                    {!! Form::text('end', $event->end, ['class' => 'form-control', 'id' => 'end']) !!}
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" onclick="clearEnd();">Clear</button>
                    </span>
                </div>
                @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
            </div>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', $event->comments, ['class' => 'form-control']) !!}
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
        $('#createdAtDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#submittedAtDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#approvedAtDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#startDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#endDatetimePicker').datetimepicker({
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
    function clearStart()  
    {
        start.value = "";
        document.getElementById("start").blur();
    }
    function clearEnd()  
    {
        end.value = "";
        document.getElementById("end").blur();
    }
</script>
@endsection
@stop