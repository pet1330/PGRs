@extends('staff.layouts.default')
@section('title')
Add a new supervisor for {{ $student->user->full_name }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => 'SupervisorsController@storeForStudent']) !!}
    <fieldset>
        {!! Form::hidden('enrolment', $student->enrolment) !!}
        <div class="form-group required">
            {!! Form::label('Supervisor') !!}
            {!! Form::select('staff_id', $staffList, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required @if ($errors->has('start')) has-error @endif">
            {!! Form::label('Start date') !!}
            {!! Form::input('date', 'start', date('Y-m-d'), ['class' => 'form-control']) !!}
            @if ($errors->has('start')) <p class="help-block">{{ $errors->first('start') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('end')) has-error @endif">
            {!! Form::label('End date') !!}
            {!! Form::input('date', 'end', date('Y-m-d'), ['class' => 'form-control']) !!}
            @if ($errors->has('end')) <p class="help-block">{{ $errors->first('end') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('order')) has-error @endif">
            {!! Form::label('Order') !!}
            {!! Form::text('order', null, ['class' => 'form-control', 'placeholder' => '1']) !!}
            @if ($errors->has('order')) <p class="help-block">{{ $errors->first('order') }}</p> @endif
        </div>
        <div class="form-group required">
            {!! Form::submit('Add supervision record', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop