@extends('staff.layouts.default')
@section('title', 'All Students')
@section('table_name', 'all-students')
@section('content')
@include('global.includes.show_alerts')
<a class="btn btn-default" href="{{ action('StudentsController@create') }}">Create new student</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-bordered table-hover" id="all-students">
    <thead>
      <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Enrolment number</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Award type</th>
        <th>Email</th>
        <th>Nationality</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Enrolment number</th>
        <th>Enrolment status</th>
        <th>Award</th>
        <th>Award type</th>
        <th>Email</th>
        <th>Nationality</th>
      </tr>
    </tfoot>
    <tbody>
      @foreach ($students as $students)
      <tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $students->enrolment]) }}">
        <th>{{ $students->user->first_name }}</th>
        <th>{{ $students->user->last_name }}</th>
        <th>{{ $students->enrolment }}</th>
        <th>{{ $students->enrolment_status->name }}</th>
        <th>{{ $students->award->name }}</th>
        <th>{{ $students->award_type->name }}</th>
        <th>{{ $students->user->email }}</th>
        <th>{{ $students->nationality }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
@include('global.includes.large_table_js')
@endsection
@stop