@extends(Auth::user()->default_layout)
@section('title')
Edit history: {{ $history->title }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::model($history, ['method' => 'PATCH', 'action' => array('HistoryController@update', 'enrolment' => $history->student->enrolment, 'id' => $history->id)]) !!}
    <fieldset>
        {!! Form::hidden('student_id', $history->student->id) !!}
        @if (Entrust::can('can_edit_any_student_history'))
        <div class="form-group required">
            {!! Form::label('Creator') !!}
            {!! Form::select('staff_id', $staffList, $history->staff_id, ['class' => 'form-control select2_enabled']) !!}
        </div>
        @else
        {!! Form::hidden('staff_id', $history->staff_id) !!}
        <div class="form-group required">
            {!! Form::label('Creator') !!}
            {!! Form::select('staff_id', $staffList, $history->staff_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
        @endif
        <div class="form-group required @if ($errors->has('title')) has-error @endif">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Content') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('created')) has-error @endif">
            {!! Form::label('Date & time') !!}
            <div class='input-group date' id='createdDatetimePicker'>
                {!! Form::input('datetime', 'created', $history->created, ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('created')) <p class="help-block">{{ $errors->first('created') }}</p> @endif
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $history->student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update history', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $(function () {
        $('#createdDatetimePicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
        });
    });
</script>
@endsection
@stop