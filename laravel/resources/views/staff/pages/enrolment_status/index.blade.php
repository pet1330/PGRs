@extends('staff.layouts.default')
@section('title', 'All Enrolment Status\'')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
    <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('EnrolmentStatusController@create') }}">Create new enrolment status</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-enrolment-status">
    <thead>
        <tr>
            <th>Name</th>
            <th>Number of students</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($enrolment_status as $enrolment_status)
        <tr href="{{ action('EnrolmentStatusController@show', ['name' => $enrolment_status->name]) }}">
          <th>{{ $enrolment_status->name }}</th>
          <th>{{ $result = App\Student::EnrolmentStatusCount($enrolment_status->id)->count() }}</th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
    $(document).ready( function () {
        responsive: true;
        $('#all-enrolment-status').DataTable({
          "iDisplayLength": 25
        });
    } );
    $('#all-enrolment-status').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
</script>
@endsection
@stop