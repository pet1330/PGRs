<div class="panel panel-default">
    <div class="panel-heading">All events</div>
    <div class="panel-body">
        @if (count($expected_events->all()) > 0 || count($submitted_events->all()) > 0 || count($approved_events->all()) > 0 )
<div class="table-responsive">
<table class="table table-hover dataTable" id="all_events_table">
<thead>
<tr>
<th>Form</th>
<th>Exp start</th>
<th>Exp end</th>
<th>Submitted/approved</th>
<th>Supervisors</th>
</tr>
</thead>
<tbody>
@foreach ($expected_events->all() as $event)
<tr class="clickable danger" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
<td>{{ $event->gs_form->name }}</td>
<td>{{ $event->exp_start }}</td>
<td>{{ $event->exp_end }}</td>
<td></td>
<td><ul class="list-unstyled" style="margin: 0"><li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@if ($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
@if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
</tr>
@endforeach
@foreach ($submitted_events->all() as $event)
<tr class="clickable warning" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
<td>{{ $event->gs_form->name }}</td>
<td>{{ $event->exp_start }}</td>
<td>{{ $event->exp_end }}</td>
<td>{{ $event->submitted_at }}</td>
<td><ul class="list-unstyled" style="margin: 0"><li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@if ($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
@if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
</tr>
@endforeach
@foreach ($approved_events->all() as $event)
<tr class="clickable success" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
<td>{{ $event->gs_form->name }}</td>
<td>{{ $event->exp_start }}</td>
<td>{{ $event->exp_end }}</td>
<td>{{ $event->approved_at }}</td>
<td><ul class="list-unstyled" style="margin: 0"><li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@if ($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
@if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
</tr>
@endforeach
</tbody>
</table>
</div>
@else
This student does not have any form submissions.
@endif
    </div>
    @if (Entrust::can('can_create_gs_form_event') || Entrust::can('can_auto_generate_gs_form_events'))
    <div class="panel-footer">
        @if (Entrust::can('can_create_gs_form_event'))
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ action('EventsController@create', ['enrolment' => $student->enrolment]) }}">Add new event</a>
        </div>
        @endif
        @if (Entrust::can('can_auto_generate_gs_form_events'))
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
               Auto generate events <i class="fa fa-chevron-down"></i>
            </button>
            <ul class="dropdown-menu slidedown">
                {{-- <li>
                    <a href="#" data-toggle="modal" data-target="#autoGenerateGS4s">
                        Auto generate GS4s
                    </a>
                </li> --}}
                <li>
                    <a href="#" data-toggle="modal" data-target="#autoGenerateGS5s">
                        Auto generate GS5s
                    </a>
                </li>
            </ul>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="autoGenerateGS5s" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Automatically generate all GS5 events</h4>
                    </div>
                    <div class="modal-body">
                        <p>This action will generate GS5 draft events every 12 months for the student's duration of study from their start date.</p>
                        <p>These events can later be manually edited or removed at any time.</p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        <div class="btn-group">
                            <form action="{{ action('StudentsController@autoGenerateGS5s', ['enrolment' => $student->enrolment]) }}" method="POST">
                                <button class="btn btn-primary" type="submit">Add GS5 events</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Modal -->
        <div class="modal fade" id="autoGenerateGS4s" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Automatically generate all GS4 events</h4>
                    </div>
                    <div class="modal-body">
                        <p>This action will generate GS4 draft events every month for the student's duration of study from their start date.</p>
                        <p>These events can later be manually edited or removed at any time.</p>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        <div class="btn-group">
                            <form action="{{ action('StudentsController@autoGenerateGS4s', ['enrolment' => $student->enrolment]) }}" method="POST">
                                <button class="btn btn-primary" type="submit">Add GS4 events</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        @endif
    </div>
    @endif
</div>