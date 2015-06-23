@extends('staff.layouts.default')
@section('title')
Edit {!! $funding->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif
    {!! Form::model($funding, ['method' => 'PATCH', 'action' => ['FundingController@update', $funding->name]]) !!}
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
            <a class="btn btn-default" href="{{ action('FundingController@show', ['name' => $funding->name]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update funding', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop