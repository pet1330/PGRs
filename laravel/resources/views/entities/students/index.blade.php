@extends(Auth::user()->default_layout)
@section('title', 'All Students')
@section('table_name', 'all-students')
@section('content')
@include('global.includes.show_alerts')
<div class="container-fluid">
  @include('entities.students.index_graphs')
</div>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-students">
    <thead>
      <tr>
        <th>Name</th>
        <th>Enrolment number</th>
        <th>Current year</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Mode of study</th>
        <th>UKBA status</th>
        <th>Funding type</th>
        <th>Email</th>
        <th>Current supervisor(s)</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Enrolment number</th>
        <th>Current year</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Mode of study</th>
        <th>UKBA status</th>
        <th>Funding type</th>
        <th>Email</th>
        <th>Current supervisor(s)</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($students as $student)
      <tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">
        <td>{{ $student->user->full_name }}</td>
        <td>{{ $student->enrolment }}</td>
        <td>@if($student->end && strtotime($student->end) < time()){{ "Completed" }}@elseif(strtotime($student->start) > time()){{ "Future" }}@else{{ $student->current_year }}@endif</td>
        <td>{{ $student->enrolment_status->name }}</td>
        <td>{{ $student->award->name }}</td>
        <td>{{ $student->mode_of_study->name }}</td>
        <td>{{ $student->ukba_status->name }}</td>
        <td>{{ $student->funding_type->name }}</td>
        <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
        <td>@if (count($student->supervisors->where('end', null)->all()) > 0)<ul class="list-unstyled" style="margin: 0">@foreach($student->supervisors->where('end', null)->all() as $supervisor)<li><small>{{ $supervisor->order }}</small> <a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}{!! '</a></li>' !!}@endforeach</ul>@else{{ 'None' }}@endif</td></tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.table-responsive -->
  @if (Entrust::can('can_create_student'))
  <div class="container-fluid" style="margin-bottom: 20px">
    <hr>
    <a class="btn btn-default" href="{{ action('StudentsController@create') }}">Create new student</a>
    @endif
  </div>
  <script type="text/javascript">
    $(document).ready( function () {

      $('#@yield('table_name')').DataTable({
        "iDisplayLength": 25,
        "order": [[ 1, "asc" ]],
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