@extends(Auth::user()->default_layout)
@section('title')
All Global Settings
@endsection
@section('content')
@include('global.includes.show_alerts')
<div class="alert alert-info">
  The following settings are <strong>global</strong> - they change parameters across the entire system. Changes made here will effect all users... You have been warned!
</div>
<div class="dataTable_wrapper">
  <table class="table table-striped" id="all-settings">
    <thead>
      <tr>
        <th>Name</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($all_settings as $key => $value)
      <tr>
        <td>{{ $key }}</td>
        <td>
          {!! Form::open(array('method' => 'PATCH', 'action' => array('SettingsController@update', $key))) !!}
          <div class="input-group @if ($errors->has('description')) has-error @endif">
            {!! Form::text($key, $value, ['class' => 'form-control']) !!}
            <span class="input-group-btn">
              {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            </span>
          </div>
          @if ($errors->has($key)) <p class="help-block">{{ $errors->first($key) }}</p> @endif
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
@endsection
@stop