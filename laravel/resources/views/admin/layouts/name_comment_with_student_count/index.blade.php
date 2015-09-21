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
          <div class="flot-chart">
            <div class="flot-chart-content" id="all_chart"></div>
          </div>
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
    var all_chart_data = [
    @foreach ($stats as $stat)
    {
      label: "{{ $stat->name }}",
      data: {{ $stat->count }}
    },
    @endforeach
    ];
    $.plot($("#all_chart"), all_chart_data, {
      series: {
        pie: {
          show: true,
          radius: 1,
          label: {
            show: true,
            radius: 2/3,
            formatter: function(label, series) {
              return '<div style="font-size:11px; text-align:center; padding:2px; color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
            },
            background: {
              opacity: 0.8,
              color: '#444'
            },
            threshold: 0.1
          }
        }
      },
      legend: {
        show: false
      }
    });
  });
</script>
@include('global.includes.large_table_js')
@endsection
@stop