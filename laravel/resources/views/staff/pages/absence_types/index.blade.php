@extends('staff.layouts.default')
@section('title', 'All Absence Types')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('AbsenceTypesController@create') }}">Create new absence type</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-absence-types">
    <thead>
      <tr>
        <th>Name</th>
        <th>Comments</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($absence_types as $absence_types)
      <tr href="{{ action('AbsenceTypesController@show', ['name' => $absence_types->name]) }}">
        <th>{{ $absence_types->name }}</th>
        <th>{{ $absence_types->comments }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
  $(document).ready( function () {
    responsive: true;
    $('#all-absence-types').DataTable({
      "iDisplayLength": 25
    });
  } );
  $('#all-absence-types').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).attr('href');
  } );
</script>
@endsection
@stop