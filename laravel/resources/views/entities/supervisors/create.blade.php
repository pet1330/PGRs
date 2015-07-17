@extends(Auth::user()->default_layout)
@section('title')
Add a new supervisor for {{ $student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'SupervisorsController@storeForStudent']) !!}
    <fieldset>
        {!! Form::hidden('student_id', $student->id) !!}
        <div class="form-group required">
            {!! Form::label('Supervisor') !!}
            {!! Form::select('staff_id', $staffList, null, ['class' => 'form-control select2_enabled']) !!}
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date') !!}
            <div class="input-group date" id="startDatePicker">
                {!! Form::text('start', date('Y-m-d'), ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('end')) has-error @endif">
            {!! Form::label('End date') !!}
            <div class="alert alert-info">If the supervision is ongoing/current please ensure the end date is blank.</div>
            <div class="input-group date" id="endDatePicker">
            {!! Form::text('end', null, ['class' => 'form-control', 'id' => 'end']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" onclick="clearEnd();">Clear</button>
                </span>
            </div>
            @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('order')) has-error @endif">
            {!! Form::label('Order') !!}
            {!! Form::text('order', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
            @if ($errors->has('order')) <p class="help-block">{{ $errors->first('order') }}</p> @endif
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add supervision record', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $(function () {
        $('#startDatePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#endDatePicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });
    function clearEnd()  
    {
        end.value = "";
        document.getElementById("end").blur();
    }
</script>
@endsection
@stop