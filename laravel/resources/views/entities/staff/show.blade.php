@extends(Auth::user()->default_layout)
@section('title')
{{ $staff->user->full_name }} Overview
@endsection
@section('page_title'){{ $staff->user->full_name }}@foreach($staff->user->roles as $role) <span class="label label-info">{{ $role->display_name }}</span>@endforeach
@endsection
@section('table_name', 'myStudents')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('global.includes.show_alerts')
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-12">
            @include('global.includes.staff.profile')
        </div>
        <div class="col-lg-7 col-md-12">
            @include('global.includes.staff.myStudents')
        </div>
    </div>
</div>
@endsection
@stop