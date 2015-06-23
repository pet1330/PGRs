@extends('staff.layouts.default')
@section('title', 'All Awards')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('AwardsController@create') }}">Create new award</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-awards">
    <thead>
      <tr>
        <th>Name</th>
        <th>Comments</th>
        <th>Number of students</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($awards as $awards)
      <tr href="{{ action('AwardsController@show', ['name' => $awards->name]) }}">
        <th>{{ $awards->name }}</th>
        <th>{{ $awards->comments }}</th>
        <th>{{ $result = App\Student::AwardCount($awards->id)->count() }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
  $(document).ready( function () {
    responsive: true;
    $('#all-awards').DataTable({
      "iDisplayLength": 25
    });
  } );
  $('#all-awards').on( 'click', 'tbody tr', function () {
    window.location.href = $(this).attr('href');
  } );
</script>
@endsection
@stop