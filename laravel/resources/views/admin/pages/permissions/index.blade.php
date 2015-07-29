@extends(Auth::user()->default_layout)
@section('title')
All {{ $pluralName }}
@endsection
@section('table_name', 'all-'.$tableName)
@section('content')
@include('global.includes.show_alerts')
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-{{ $tableName }}">
    <thead>
      <tr>
        <th>Display name</th>
        <th>Description</th>
        <th>Roles with permission</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Display name</th>
        <th>Description</th>
        <th>Roles with permission</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($entities as $entity)
      <tr>
        <td>{{ $entity->display_name }}</td>
        <td>{{ $entity->description }}</td>
        <td><ul>@foreach($entity->roles as $role)<li><a href="{{ action('RolesController@show', ['name' => $role->name]) }}">{{ $role->display_name }}</a></li>@endforeach</ul></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
  $(document).ready( function () {

    $('#@yield('table_name')').DataTable({
      "iDisplayLength": 25,
    });

    // Setup - add a text input to each footer cell
    $('#@yield('table_name') tfoot th').each( function () {
      var title = $('#@yield('table_name') thead th').eq( $(this).index() ).text();
      $(this).html( '<input type="text" placeholder="Filter" />' );
    } );
    
    // DataTable
    var table = $('#@yield('table_name')').DataTable();
    
    // Apply the search
    table.columns().every( function () {
      var that = this;
      
      $( 'input', this.footer() ).on( 'keyup change', function () {
        that
        .search( this.value )
        .draw();
      } );
    } );

  } );
</script>
@endsection
@stop