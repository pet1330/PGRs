@extends('staff.layouts.default')
@section('title', 'All Staff')
@section('table_name', 'all-staff')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
    <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('StaffController@create') }}">Create anew staff member</a>
<hr>
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
        <tr href="{{ action('StaffController@show', ['name' => $staff->name]) }}">
          <th>{{ $staff->user->title }} {{ $staff->user->first_name }} {{ $staff->user->middle_name }} {{ $staff->user->last_name }}</th>
          <th>{{ $staff->user->email }}</th>
          <th>{{ $staff->university_phone }}</th>
          <th>{{ $staff->user->personal_phone }}</th>
          <th>{{ $staff->user->personal_email }}</th>
          <th>{{ $staff->room }}</th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
<!-- /.table-responsive -->
@include('global.includes.large_table_js')
@endsection
@stop