@extends(Auth::user()->default_layout)
@section('title', 'My Students')
@section('content')
<div class="container-fluid">
	<div class="row">
		@include('global.includes.show_alerts')
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6">
			@include('staff.includes.dashboard.supervising')
		</div>
		<div class="col-lg-6 col-md-6">
			@include('staff.includes.dashboard.upcoming_events')
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#1_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#2_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#3_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#1_past_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#2_past_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#3_past_supervisor_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$('#all_upcoming_events_table').on( 'click', 'tbody tr', function () {
		window.location.href = $(this).attr('href');
	} );
	$(document).ready(function() {
		$('#1_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#2_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#3_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#1_past_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#2_past_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#3_past_supervisor_table').dataTable( {
			"order": [[ 0, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
		$('#all_upcoming_events_table').dataTable( {
			"order": [[ 2, "asc" ]],
			"filter":   false,
			"info":     false,
			"paging":   true,
			"lengthChange": false
		} );
	} );
</script>
@endsection
@stop