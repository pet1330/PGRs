@extends('staff.layouts.default')
@section('title', 'All Students')
@section('content')
<a class="btn btn-default" href="{{ action('StudentsController@create') }}">Create new student</a>
<hr>
<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    <hr>
@endif
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-students">
    <thead>
        <tr>
            <th>First name</th>
            <th>Last Name</th>
            <th>Enrolment number</th>
            <th>Level</th>
            <th>Email</th>
            <th>Registered on</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $students)
        <tr href="{{ action('StudentsController@show', ['enrolment' => $students->enrolment]) }}">
          <th>{{ $students->user->first_name }}</th>
          <th>{{ $students->user->last_name }}</th>
          <th>{{ $students->enrolment }}</th>
          <th>{{ $students->level->name }}</th>
          <th>{{ $students->user->email }}</th>
          <th>{{ $students->created_at }}</th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
    $(document).ready( function () {
        responsive: true;
        $('#all-students').DataTable({
          "iDisplayLength": 25
        });
    } );
    $('#all-students').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
</script>
@endsection
@stop