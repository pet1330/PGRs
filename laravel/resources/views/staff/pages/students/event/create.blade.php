@extends('staff.layouts.default')
@section('title')
Create a event for {{ $student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'EventsController@store']) !!}
    <fieldset>
        {!! Form::hidden('student_id', $student->id) !!}
        <div class="form-group required @if ($errors->has('title')) has-error @endif">
            {!! Form::label('Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>
        <div class="form-group">
            {!! Form::label('Event content') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('created')) has-error @endif">
            {!! Form::label('Date & time') !!}
            <div class='input-group date' id='createdDatetimePicker'>
                {!! Form::input('datetime', 'created', date('Y-m-d G-H-s'), ['class' => 'form-control']) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @if ($errors->has('created')) <p class="help-block">{{ $errors->first('created') }}</p> @endif
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show') }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add event', ['class' => 'btn btn-primary']) !!}
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