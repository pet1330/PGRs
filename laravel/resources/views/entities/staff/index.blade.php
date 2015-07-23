@extends(Auth::user()->default_layout)
@section('title', 'All Staff')
@section('table_name', 'all-staff')
@section('content')
@include('global.includes.show_alerts')
@if (Entrust::can('can_create_staff'))
<a class="btn btn-default" href="{{ action('StaffController@create') }}">Create a new staff member</a>
<hr>
@endif
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-staff">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>University phone</th>
        <th>Personal phone</th>
        <th>Personal email</th>
        <th>Room</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>University phone</th>
        <th>Personal phone</th>
        <th>Personal email</th>
        <th>Room</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($staff as $staff)
      <tr class="clickable" href="{{ action('StaffController@show', ['id' => $staff->id]) }}">
        <td>{{ $staff->user->full_name }}</td>
        <td><a href="mailto:{{ $staff->user->email }}">{{ $staff->user->email }}</a></td>
        <td><a href="tel:{{ $staff->university_phone }}">{{ $staff->university_phone }}</a></td>
        <td><a href="tel:{{ $staff->personal_phone }}">{{ $staff->user->personal_phone }}</a></td>
        <td><a href="mailto:{{ $staff->user->personal_email }}">{{ $staff->user->personal_email }}</a></td>
        <td>{{ $staff->room }}</td>
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
      "order": [[ 0, "asc" ]],
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