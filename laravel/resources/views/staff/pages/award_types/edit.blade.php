@extends('staff.layouts.default')
@section('title')
Edit {!! $award_type->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @endif
    {!! Form::model($award_type, ['method' => 'PATCH', 'action' => ['AwardTypesController@update', $award_type->name]]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('AwardTypesController@show', ['name' => $award_type->name]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update award type', ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop