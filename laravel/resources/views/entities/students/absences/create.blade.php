@extends(Auth::user()->default_layout)
@section('title')
Create absence record for {{ $student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6" style="margin-bottom: 20px">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => array('AbsencesController@store', 'enrolment' => $student->enrolment)]) !!}
    <fieldset>
        <div class="form-group required">
            {!! Form::label('Absence Type') !!}
            {!! Form::select('absence_type_id', $absence_types, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date & time') !!}
            <div class='input-group date' id='startDatetimePicker'>
                {!! Form::text('start', null, ['class' => 'form-control', 'id' => 'start']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('end')) has-error @endif">
            {!! Form::label('End date & time') !!}
            <div class='input-group date' id='endDatetimePicker'>
                {!! Form::text('end', null, ['class' => 'form-control', 'id' => 'end']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Create absence', ['class' => 'btn btn-primary']) !!}
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