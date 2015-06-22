@extends('staff.layouts.default')
@section('title')
Edit {{ $level->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 "> 

    <div class="col-lg-6 col-md-6">
        {!! Form::open(['action' => 'LevelController@store']) !!}
        <fieldset>
            <div class="form-group">
                {!! Form::label('Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => $level->name]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Comments') !!}
                {!! Form::textarea('comments', null, ['class' => 'form-control', 'placeholder' => $level->comments]) !!}
            </div>
            <a class="btn btn-default" href="{{ action('LevelController@show', ['name' => $level->name]) }}">Cancel</a>
            <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </div>
        </fieldset>
        {!! Form::close() !!}
    </div>
    @endsection
    @stop