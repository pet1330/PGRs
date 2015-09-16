@extends(Auth::user()->default_layout)
@section('title')
All {{ $pluralName }}
@endsection
@section('table_name', 'all-'.$tableName)
@section('content')
@include('global.includes.show_alerts')
<a class="btn btn-default" href="{{ action($controllerName.'@create') }}">Create new {{ $singleName }}</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-{{ $tableName }}">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Default start month</th>
        <th>Approved date/time enabled</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Default start month</th>
        <th>Approved date/time enabled</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($entities as $entity)
      <tr class="clickable" href="{{ url($indexUrl, ['id' => $entity->id]) }}">
        <td>{{ $entity->name }}</td>
        <td>{{ $entity->description }}</td>
        <td>{{ $entity->defaultStartMonth }}</td>
        <td>@if($entity->approved_enabled)Yes @else No @endif</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
@include('global.includes.large_table_js')
@endsection
@stop