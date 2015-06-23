@extends('staff.layouts.default')
@section('title')
Create a new award
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif
    {!! Form::open(['action' => 'AwardsController@store']) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Comments') !!}
            {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('AwardsController@index') }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add award', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop