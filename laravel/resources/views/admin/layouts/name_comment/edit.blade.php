@extends('staff.layouts.default')
@section('title')
Edit {{ $singleName }}: {!! $entity->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::model($entity, ['method' => 'PATCH', 'action' => [$controllerName.'@update', $entity->name]]) !!}
    <fieldset>
        <div class="form-group required @if ($errors->has('name')) has-error @endif">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ url($indexUrl, ['name' => $entity->name]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update '.$singleName, ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop