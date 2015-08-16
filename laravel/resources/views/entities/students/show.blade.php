@extends(Auth::user()->default_layout)
@section('title')
{{ $student->user->full_name }} Overview
@endsection
@section('page_title')
{{ $student->user->full_name }} <small>{{ $student->enrolment }}</small> @foreach($student->user->roles as $role) <span class="label label-info">{{ $role->display_name }}</span>@endforeach @if($student->end && strtotime($student->end) < time()) <span class="label label-warning">Completed study</span>@elseif(strtotime($student->start) > time()) <span class="label label-success">Future student</span>@else <span class="label label-success">Year {{ $student->current_year }}</span>@endif @if($student->time_since_last_gs5) <span class="label label-primary">Last GS5 {{ $student->time_since_last_gs5 }}</span>@endif @if(count($upcoming_events->all()) == 1)<span class="label label-warning">1 Upcoming event</span>@elseif(count($upcoming_events->all()) > 1)<span class="label label-warning">{{ count($upcoming_events->all()) }} Upcoming events</span>@endif @if($student->user->locked == '1')<span class="label label-danger">Account login disabled</span>@endif
@endsection
@section('table_name', 'supervisors')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('global.includes.show_alerts')
        @if(count($expected_events->all()) > 0 || count($submitted_events->all()) > 0 || count($approved_events->all()) > 0 )
        @include('global.includes.student.timeline')
        @endif
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12">
            @include('global.includes.student.profile')
            @include('global.includes.student.absences')
        </div>
        <div class="col-lg-7 col-md-12">
            @if(count($upcoming_events->all()) > 0)
            @include('global.includes.student.upcoming_events')
            @endif
            @include('global.includes.student.supervisors')
            @include('global.includes.student.events')
            @if (Entrust::can('can_view_any_student_history') || (Entrust::can('can_view_my_students_history') && Auth::user()->staff->isMyStudent($student->id)))
            @include('global.includes.student.history')
            @endif
        </div>
    </div>
</div>
@endsection
@stop