@extends(Auth::user()->default_layout)
@section('title')
{{ $staff->user->full_name }} Overview
@endsection
@section('page_title')
{{ $staff->user->full_name }} <span class="label label-info">Staff</span>
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
    $(document).ready(function() {
        $('#1_supervisor_table').dataTable( {
            "order": [[ 1, "desc" ]],
            "filter":   false,
            "info":     false,
            "paging":   true,
            "lengthChange": false
        } );
        $('#2_supervisor_table').dataTable( {
            "order": [[ 1, "desc" ]],
            "filter":   false,
            "info":     false,
            "paging":   true,
            "lengthChange": false
        } );
        $('#3_supervisor_table').dataTable( {
            "order": [[ 1, "desc" ]],
            "filter":   false,
            "info":     false,
            "paging":   true,
            "lengthChange": false
        } );
    } );
</script>
@endsection
@stop