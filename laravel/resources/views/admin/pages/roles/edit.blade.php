@extends(Auth::user()->default_layout)
@section('title')
Edit {{ $singleName }}: {!! $entity->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::model($entity, ['method' => 'PATCH', 'action' => [$controllerName.'@update', $entity->name]]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
        <div class="alert alert-info">
            The name attribute cannot be changed once the role has been created.
        </div>
        <div class="form-group required @if ($errors->has('display_name')) has-error @endif">
            {!! Form::label('Display name') !!}
            {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('display_name')) <p class="help-block">{{ $errors->first('display_name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('permissions')) has-error @endif">
            {!! Form::label('Permissions') !!}
            {!! Form::select('permissions[]', $all_permissions, $entity->perms->lists('id')->all(), ['multiple' => true, 'class' => 'form-control  select2_enabled']) !!}
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