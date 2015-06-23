@extends('staff.layouts.default')
@section('title', 'All Award Types')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
    <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('AwardTypesController@create') }}">Create new award type</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-award-types">
    <thead>
        <tr>
            <th>Name</th>
            <th>Number of students</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($award_types as $award_types)
        <tr href="{{ action('AwardTypesController@show', ['name' => $award_types->name]) }}">
          <th>{{ $award_types->name }}</th>
          <th>{{ $result = App\Student::AwardTypeCount($award_types->id)->count() }}</th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
    $(document).ready( function () {
        responsive: true;
        $('#all-award-types').DataTable({
          "iDisplayLength": 25
        });
    } );
    $('#all-award-types').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
</script>
@endsection
@stop