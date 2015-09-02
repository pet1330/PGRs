@extends(Auth::user()->default_layout)
@section('title', 'All Upcoming Events')
@section('table_name', 'all-events')
@section('content')
@include('global.includes.show_alerts')
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-events">
    <thead>
      <tr>
        <th>Form</th>
        <th>Student</th>
        <th>Enrolment number</th>
        <th>Created at</th>
        <th>Start</th>
        <th>End</th>
        <th>Time until start</th>
        <th>Supervisors</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Form</th>
        <th>Student</th>
        <th>Enrolment number</th>
        <th>Created at</th>
        <th>Start</th>
        <th>End</th>
        <th>Time until start</th>
        <th>Supervisors</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($upcoming_events as $event)
      <tr class="clickable" href="{{ action('EventsController@show', ['enrolment' => $event->student->enrolment, 'id' => $event->id]) }}">
        <td>{{ $event->gs_form->name }}</td>
        <td><a href="{{ action('StudentsController@show', ['enrolment' => $event->student->enrolment]) }}">{{ $event->student->user->full_name }}</a></td>
        <td>{{ $event->student->enrolment }}</td>
        <td>{{ Carbon\Carbon::parse($event->created_at)->toDateString() }}</td>
        <td>{{ $event->start }}</td>
        <td>{{ $event->end }}</td>
        <td>{{ Carbon\Carbon::parse($event->start)->diffForHumans() }}</td>
        <td><ul class="list-unstyled" style="margin: 0">
          @if($event->directorOfStudy)
          <li>
            <small>1</small> <a href="{{ action('StaffController@show', ['id' => $event->directorOfStudy->id]) }}">{{ $event->directorOfStudy->user->full_name }}</a>
          </li>
          @endif
          @if($event->secondSupervisor)
          <li>
            <small>2</small> <a href="{{ action('StaffController@show', ['id' => $event->secondSupervisor->id]) }}">{{ $event->secondSupervisor->user->full_name }}</a>
          </li>
          @endif
          @if($event->thirdSupervisor)
          <li>
            <small>3</small> <a href="{{ action('StaffController@show', ['id' => $event->thirdSupervisor->id]) }}">{{ $event->thirdSupervisor->user->full_name }}</a>
          </li>
          @endif
        </ul></td>
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
      "order": [[ 3, "asc" ]],
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