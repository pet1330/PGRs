@extends(Auth::user()->default_layout)
@section('title')
Reports admin
@endsection
@section('content')

<!-- Start of Reportico Admin -->
<?php
$_REQUEST["clear_session"] = 1;
$engine = App::make("getReporticoEngine");
$engine->initial_execute_mode = "ADMIN";
$engine->access_mode = "FULL";
$engine->initial_project = "pgrs-admin-reporting";
$engine->clear_reportico_session = true;
$engine->execute();
?> 
<!-- End of Reportico Admin -->

@endsection
@stop