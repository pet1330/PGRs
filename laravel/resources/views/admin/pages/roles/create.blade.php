@extends(Auth::user()->default_layout)
@section('title')
Create a new {{ $singleName }}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::open(['action' => $controllerName.'@store']) !!}
    <fieldset>
        <div class="form-group required @if ($errors->has('name')) has-error @endif">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>
        <div class="form-group required @if ($errors->has('display_name')) has-error @endif">
            {!! Form::label('Display name') !!}
            {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('display_name')) <p class="help-block">{{ $errors->first('display_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action($controllerName.'@index') }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Add '.$singleName, ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop