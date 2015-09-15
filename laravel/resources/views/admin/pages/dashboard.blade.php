@extends(Auth::user()->default_layout)
@section('title', 'Administrator Dashboard')
@section('content')
<div class="container-fluid">
	@include('entities.students.index_graphs')
</div>
<div class="row">
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-primary" onclick="location.href='{{ action('StudentsController@index') }}';">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-graduation-cap fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Students</div>
						<div>Student management</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-primary" onclick="location.href='{{ action('StaffController@index') }}';">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Staff</div>
						<div>Staff management</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-primary" onclick="location.href='/events';">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-calendar fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Events</div>
						<div>Events overview</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		<div class="panel panel-primary" onclick="location.href='/reports';">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-bar-chart-o fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Reports</div>
						<div>Generate reports</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<span class="pull-left">View Details</span>
				<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@stop