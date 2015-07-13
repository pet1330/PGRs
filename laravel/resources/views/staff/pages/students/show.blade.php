@extends('staff.layouts.student_overview')
@section('title')
{{ $student->user->full_name }} Overview
@endsection
@section('page_title')
{{ $student->user->full_name }} <small>{{ $student->enrolment }}</small> @if ($student->end != NULL && strtotime($student->end) < time()) <span class="label label-warning">Completed study</span>@else <span class="label label-info">Year {{ $student->current_year }}</span>@endif
@endsection
@section('table_name', 'supervisors')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('global.includes.show_alerts')
        @include('global.includes.student.timeline')
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12">
            @include('global.includes.student.profile')
        </div>
        <div class="col-lg-7 col-md-12">
            @include('global.includes.student.supervisors')
            @include('global.includes.student.gs_forms')
            @include('global.includes.student.history')
        </div>
    </div>
</div>
<script type="text/javascript">
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
    $(document).ready(function() {
        $('#all_events_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
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
    } );
</script>
@endsection
@stop