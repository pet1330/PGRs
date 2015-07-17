@extends('staff.layouts.default')
@section('title', 'All Supervisors')
@section('table_name', 'all-supervisors')
@section('content')
@include('global.includes.show_alerts')
<a class="btn btn-default" href="{{ action('SupervisorsController@create') }}">Create new supervisor</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-supervisors">
    <thead>
      <tr>
        <th>Student name</th>
        <th>Student enrolment ID</th>
        <th>Staff name</th>
        <th>Order</th>
        <th>Start</th>
        <th>End</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Student name</th>
        <th>Student enrolment ID</th>
        <th>Staff name</th>
        <th>Order</th>
        <th>Start</th>
        <th>End</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($supervisors as $supervisor)
      <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
        <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->user->full_name }}</a></td>
        <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->enrolment }}</a></td>
        <td><a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}</td>
        <td>{{ $supervisor->order }}</td></td>
        <td>{{ $supervisor->start }}</td>
        <td>@if ($supervisor->end === null)<span class="label label-success">Current supervisor</span> @else {{ $supervisor->end }} @endif</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
@include('global.includes.large_table_js')
@endsection
@stop