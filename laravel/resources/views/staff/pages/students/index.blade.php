@extends('staff.layouts.default')
@section('title', 'All Students')
@section('table_name', 'all-students')
@section('content')
@include('global.includes.show_alerts')
<a class="btn btn-default" href="{{ action('StudentsController@create') }}">Create new student</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-students">
    <thead>
      <tr>
        <th>Name</th>
        <th>Enrolment number</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Mode of study</th>
        <th>Email</th>
        <th>Current supervisor(s)</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Enrolment number</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Mode of study</th>
        <th>Email</th>
        <th>Current supervisor(s)</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($students as $student)
      <tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">
        <td>{{ $student->user->full_name }}</td>
        <td>{{ $student->enrolment }}</td>
        <td>{{ $student->enrolment_status->name }}</td>
        <td>{{ $student->award->name }}</td>
        <td>{{ $student->mode_of_study->name }}</td>
        <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
        <td>@if (count($student->supervisors->where('end', null)->all()) > 0){!! '<ul class="list-unstyled" style="margin: 0">' !!}@foreach($student->supervisors->where('end', null)->all() as $supervisor)<li><a href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">{{ $supervisor->staff->user->full_name }}{!! '</a></li>' !!}@endforeach</ul>@else{{ 'No current supervisor' }}@endif{!! '</td></tr>' !!}
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.table-responsive -->
  @include('global.includes.large_table_js')
  @endsection
  @stop