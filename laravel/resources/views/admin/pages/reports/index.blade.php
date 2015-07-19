@extends(Auth::user()->default_layout)
@section('title')
Reports
@endsection
@section('content')

<!-- Start of Reportico Report -->
<?php
$_REQUEST["clear_session"] = 1;
$engine = App::make("getReporticoEngine");
$engine->initial_execute_mode = "ADMIN";
$engine->access_mode = "ONEPROJECT";
$engine->initial_project = "pgrs-admin-reporting";
$engine->clear_reportico_session = true;
$engine->execute();
?> 
<!-- End of Reportico Report -->

@endsection
@stop