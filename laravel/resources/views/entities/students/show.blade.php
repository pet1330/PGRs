@extends(Auth::user()->default_layout)
@section('title')
{{ $student->user->full_name }} Overview
@endsection
@section('page_title')
{{ $student->user->full_name }} <small>{{ $student->enrolment }}</small> @if ($student->end && strtotime($student->end) < time()) <span class="label label-warning">Completed study</span>@else <span class="label label-success">Year {{ $student->current_year }}</span>@endif @if(count($upcoming_events->all()) == 1)<span class="label label-warning">1 Upcoming event</span>@elseif(count($upcoming_events->all()) > 1)<span class="label label-warning">{{ count($upcoming_events->all()) }} Upcoming events</span>@endif @if ($student->time_since_last_gs5) <span class="label label-primary">Last GS5 {{ $student->time_since_last_gs5 }}</span>@endif @foreach($student->user->roles as $role) <span class="label label-info">{{ $role->display_name }}</span>@endforeach
@endsection
@section('table_name', 'supervisors')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('global.includes.show_alerts')
        @if (count($draft_events->all()) > 0 || count($submitted_events->all()) > 0 || count($approved_events->all()) > 0 )
        @include('global.includes.student.timeline')
        @endif
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12">
            @include('global.includes.student.profile')
            @include('global.includes.student.absences')
        </div>
        <div class="col-lg-7 col-md-12">
            @include('global.includes.student.supervisors')
            @if (count($upcoming_events->all()) > 0)
            @include('global.includes.student.upcoming_events')
            @endif
            @include('global.includes.student.gs_forms')
            @include('global.includes.student.history')
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