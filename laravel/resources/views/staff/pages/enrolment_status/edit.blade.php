@extends('staff.layouts.default')
@section('title')
Edit {!! $enrolment_status->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif
    {!! Form::model($enrolment_status, ['method' => 'PATCH', 'action' => ['EnrolmentStatusController@update', $enrolment_status->name]]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('EnrolmentStatusController@show', ['name' => $enrolment_status->name]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update enrolment status', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop