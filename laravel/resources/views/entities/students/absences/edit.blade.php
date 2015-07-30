@extends(Auth::user()->default_layout)
@section('title')
Edit {{ $absence->absence_type->name }} absence record for {{ $absence->student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::model($absence, ['method' => 'PATCH', 'action' => array('AbsencesController@update', 'enrolment' => $absence->student->enrolment, 'id' => $absence->id)]) !!}
    <fieldset>
        <div class="form-group required">
            {!! Form::label('Absence Type') !!}
            {!! Form::select('absence_type_id', $absence_types, $absence->absence_type_id, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date & time') !!}
            <div class='input-group date' id='startDatetimePicker'>
                {!! Form::text('start', $absence->start, ['class' => 'form-control', 'id' => 'start']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('end')) has-error @endif">
            {!! Form::label('End date & time') !!}
            <div class='input-group date' id='endDatetimePicker'>
                {!! Form::text('end', $absence->end, ['class' => 'form-control', 'id' => 'end']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', $absence->description, ['class' => 'form-control']) !!}
        </div>

        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('AbsencesController@show', ['enrolment' => $absence->student->enrolment, 'id' => $absence->id]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update absence', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $(function () {
        $('#startDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
        $('#endDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
    });
</script>
@endsection
@stop