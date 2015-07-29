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
        <th>Display name</th>
        <th>Description</th>
        <th>Number of users</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Display name</th>
        <th>Description</th>
        <th>Number of users</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($entities as $entity)
      <tr class="clickable" href="{{ url($indexUrl, ['name' => $entity->name]) }}">
        <td>{{ $entity->display_name }}</td>
        <td>{{ $entity->description }}</td>
        <td>{{ $result = App\Role::find($entity->id)->users()->count() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
@include('global.includes.large_table_js')
@endsection
@stop