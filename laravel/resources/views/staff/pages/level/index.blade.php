@extends('staff.layouts.default')
@section('title', 'All Levels')
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('success_message'))
    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
@endif
@if (Session::has('info_message'))
    <div class="alert alert-info">{{ Session::get('info_message') }}</div>
@endif
<a class="btn btn-default" href="{{ action('LevelController@create') }}">Create new level</a>
<hr>
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="all-levels">
    <thead>
        <tr>
            <th>Name</th>
            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($levels as $levels)
        <tr href="{{ action('LevelController@show', ['name' => $levels->name]) }}">
          <th>{{ $levels->name }}</th>
          <th>{{ $levels->comments }}</th>
      </tr>
      @endforeach
  </tbody>
</table>
</div>
<!-- /.table-responsive -->
<script type="text/javascript">
    $(document).ready( function () {
        responsive: true;
        $('#all-levels').DataTable({
          "iDisplayLength": 25
        });
    } );
    $('#all-levels').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
</script>
@endsection
@stop