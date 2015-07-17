@extends(Auth::user()->default_layout)
@section('title')
All {{ $pluralName }}
@endsection
@section('table_name', 'all-'.$tableName)
@section('content')
@include('global.includes.show_alerts')
<div class="container-fluid">
  <div class="row" style="margin-bottom: 20px">
    <div class="col-sm-12 col-xs-12">
      <div class="btn-group" role="group">
        <a class="btn btn-default" href="{{ action($controllerName.'@create') }}">Create new {{ $singleName }}</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12">
      <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="all-{{ $tableName }}">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Number of students</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Number of students</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($entities as $entity)
            <tr class="clickable" href="{{ url($indexUrl, ['name' => $entity->name]) }}">
              <th>{{ $entity->name }}</th>
              <th>{{ $entity->description }}</th>
              <th>{{ $result = App\Student::EntityCount($tableName, $entity->id)->count() }}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Chart overview
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div id="donut-all"></div>
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
  </div>
</div>
<script type="text/javascript">
  $(document).ready( function () {

    Morris.Donut({
      element: 'donut-all',
      data: [
      @foreach ($entities as $entity)
      @if (App\Student::EntityCount($tableName, $entity->id)->count() > 0)
      {label: "{{ $entity->name }}", value: {{ $result = App\Student::EntityCount($tableName, $entity->id)->count() }} },
      @endif
      @endforeach
      ]
    });

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

$('#@yield('table_name')').on( 'click', 'tbody tr', function () {
  window.location.href = $(this).attr('href');
} );
</script>
@endsection
@stop