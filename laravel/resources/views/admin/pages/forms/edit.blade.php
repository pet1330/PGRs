@extends(Auth::user()->default_layout)
@section('title')
Edit {{ $singleName }}: {!! $entity->name !!}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::model($entity, ['method' => 'PATCH', 'action' => [$controllerName.'@update', $entity->id]]) !!}
    <fieldset>
        <div class="form-group required @if ($errors->has('name')) has-error @endif">
            {!! Form::label('Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
        </div>
        <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
        </div>
        <div class="alert alert-info"><p>The default start month is the number of months into the student's study that the form will typically occur. This value is used during the auto-generation of a new students timeline, it can be left blank though.</p><p>For example if the event for this form will typically take place after 2 years of full-time study then enter 24.</p><p>It's important to note that the value entered should always refer to a typical <b>full-time student</b> and will be modified for use with part-time and distance learning accounts automatically.</p></div>
        <div class="form-group @if ($errors->has('defaultStartMonth')) has-error @endif">
            {!! Form::label('Default start month') !!}
            {!! Form::text('defaultStartMonth', null, ['class' => 'form-control']) !!}
            @if ($errors->has('defaultStartMonth')) <p class="help-block">{{ $errors->first('defaultStartMonth') }}</p> @endif
        </div>
        <div class="alert alert-info"><p>Enable if the form features an approval date.</p></div>
        <div class="form-group @if ($errors->has('approved_enabled')) has-error @endif">
            {!! Form::label('Approved date/time enabled') !!}
            {!! Form::checkbox('approved_enabled', '1', '0') !!}
            @if ($errors->has('approved_enabled')) <p class="help-block">{{ $errors->first('approved_enabled') }}</p> @endif
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ url($indexUrl, ['id' => $entity->id]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update '.$singleName, ['class' => 'btn btn-primary']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop