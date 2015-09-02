<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">Current Students</a> <span class="badge">{{ $myStudents_1->count() + $myStudents_2->count() + $myStudents_3->count() }}</span>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#1_supervisor" data-toggle="tab" aria-expanded="true">Director of Study <span class="badge">{{ $myStudents_1->count() }}</span></a>
					</li>
					<li class=""><a href="#2_supervisor" data-toggle="tab" aria-expanded="false">Second Supervisor <span class="badge">{{ $myStudents_2->count() }}</span></a>
					</li>
					<li class=""><a href="#3_supervisor" data-toggle="tab" aria-expanded="false">Third Supervisor <span class="badge">{{ $myStudents_3->count() }}</span></a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="1_supervisor" aria-labelledby="1_supervisor-tab">
						@if (count($myStudents_1->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="1_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($myStudents_1->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the Director of study for any students.
						@endif
					</div>
					<div role="tabpanel" class="tab-pane fade" id="2_supervisor" aria-labelledby="2_supervisor-tab">
						@if (count($myStudents_2->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="2_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($myStudents_2->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the Second Supervisor for any students.
						@endif
					</div>
					<div role="tabpanel" class="tab-pane fade" id="3_supervisor" aria-labelledby="3_supervisor-tab">
						@if (count($myStudents_3->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="3_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($myStudents_3->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the Third Supervisor for any students.
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">Past Students</a> <span class="badge">{{ $past_myStudents_1->count() + $past_myStudents_2->count() + $past_myStudents_3->count() }}</span>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#1_past_supervisor" data-toggle="tab" aria-expanded="true">Director of Study <span class="badge">{{ $past_myStudents_1->count() }}</span></a>
					</li>
					<li class=""><a href="#2_past_supervisor" data-toggle="tab" aria-expanded="false">Second Supervisor <span class="badge">{{ $past_myStudents_2->count() }}</span></a>
					</li>
					<li class=""><a href="#3_past_supervisor" data-toggle="tab" aria-expanded="false">Third Supervisor <span class="badge">{{ $past_myStudents_3->count() }}</span></a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="1_past_supervisor" aria-labelledby="1_past_supervisor-tab">
						@if (count($past_myStudents_1->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="1_past_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
										<th>End</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($past_myStudents_1->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
										<td>{{ $supervisor->end }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the previous Director of study for any students.
						@endif
					</div>
					<div role="tabpanel" class="tab-pane fade" id="2_past_supervisor" aria-labelledby="2_past_supervisor-tab">
						@if (count($past_myStudents_2->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="2_past_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
										<th>End</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($past_myStudents_2->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
										<td>{{ $supervisor->end }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the previous Second Supervisor for any students.
						@endif
					</div>
					<div role="tabpanel" class="tab-pane fade" id="3_past_supervisor" aria-labelledby="3_past_supervisor-tab">
						@if (count($past_myStudents_3->all()) > 0 )
						<div class="table-responsive">
							<table class="table table-hover dataTable" id="3_past_supervisor_table">
								<thead>
									<tr>
										<th>Student</th>
										<th>Enrolment ID</th>
										<th>Award</th>
										<th>Start</th>
										<th>End</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($past_myStudents_3->all() as $supervisor)
									<tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">
										<td>{{ $supervisor->student->user->full_name }}</td>
										<td>{{ $supervisor->student->enrolment }}</td>
										<td>{{ $supervisor->student->award->name }}</td>
										<td>{{ $supervisor->start }}</td>
										<td>{{ $supervisor->end }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						You are not the previous Third Supervisor for any students.
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>