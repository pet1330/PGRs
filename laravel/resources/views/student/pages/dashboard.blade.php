@extends('student.layouts.full_width')
@section('title', 'Student Dashboard')
@section('content')
<div class="container-fluid">
	<div class="row">
		@include('global.includes.show_alerts')
		@if (count($expected_events->all()) > 0 || count($submitted_events->all()) > 0 || count($approved_events->all()) > 0 )
		@include('global.includes.student.timeline')
		@endif
	</div>
	<div class="row">
		<div class="col-lg-5 col-md-12">
			@include('global.includes.student.profile')
			@include('global.includes.student.absences')
		</div>
		<div class="col-lg-7 col-md-12">
            @if (count($upcoming_events->all()) > 0)
            @include('global.includes.student.upcoming_events')
            @endif
            @include('global.includes.student.supervisors')
            @include('global.includes.student.events')
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#upcoming_events_table').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#all_events_table').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#current_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#previous_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#all_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#absences_table').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $(document).ready(function() {
        $('#upcoming_events_table').dataTable( {
            "order": [[ 1, "desc" ]],
            "filter":   false,
            "info":     false,
            "paging":   false,
            "lengthChange": false
        } );
        $('#all_events_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "filter":   false,
            "info":     false,
            "paging":   true,
            "lengthChange": false
        } );
        $('#current_supervisors_table').dataTable( {
            "order": [[ 2, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#previous_supervisors_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#all_supervisors_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#absences_table').dataTable( {
            "order": [[ 2, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
    } );
</script>
@endsection
@stop