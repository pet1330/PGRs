<div class="panel panel-default">
    <div class="panel-heading">All events</div>
    <div class="panel-body">
        @if (count($expected_events->all()) > 0 || count($submitted_events->all()) > 0 || count($approved_events->all()) > 0 )
        <div class="table-responsive">
            <table class="table table-hover dataTable" id="all_events_table">
                <thead>
                    <tr>
                        <th>Form</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Created</th>
                        <th>Submitted</th>
                        <th>Approved</th>
                        <th>Supervisors</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expected_events->all() as $event)
                    <tr class="clickable danger" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
                        <td>{{ $event->gs_form->name }}</td>
                        <td>{{ $event->start }}</td>
                        <td>{{ $event->end }}</td>
                        <td>{{ Carbon\Carbon::parse($event->created_at)->toDateString() }}</td>
                        <td></td>
                        <td></td>
                        <td><ul class="list-unstyled" style="margin: 0">@if($event->directorOfStudy)<li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@endif
                            @if($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
                            @if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
                        </tr>
                        @endforeach
                        @foreach ($submitted_events->all() as $event)
                        <tr class="clickable warning" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
                            <td>{{ $event->gs_form->name }}</td>
                            <td>{{ $event->start }}</td>
                            <td>{{ $event->end }}</td>
                            <td>{{ Carbon\Carbon::parse($event->created_at)->toDateString() }}</td>
                            <td>{{ Carbon\Carbon::parse($event->submitted_at)->toDateString() }}</td>
                            <td></td>
                            <td><ul class="list-unstyled" style="margin: 0">@if($event->directorOfStudy)<li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@endif
                                @if($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
                                @if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
                            </tr>
                            @endforeach
                            @foreach ($approved_events->all() as $event)
                            <tr class="clickable success" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
                                <td>{{ $event->gs_form->name }}</td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>{{ Carbon\Carbon::parse($event->created_at)->toDateString() }}</td>
                                <td>{{ Carbon\Carbon::parse($event->submitted_at)->toDateString() }}</td>
                                <td>{{ Carbon\Carbon::parse($event->approved_at)->toDateString() }}</td>
                                <td><ul class="list-unstyled" style="margin: 0">@if($event->directorOfStudy)<li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@endif
                                    @if($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
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
                        <li>
                            <a href="#" data-toggle="modal" data-target="#autoGenerateGS3">
                                Auto generate GS3
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#autoGenerateGS5s">
                                Auto generate GS5s
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#autoGenerateGS5b">
                                Auto generate GS5b
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#autoGenerateGS7">
                                Auto generate GS7
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#autoGenerateGS8">
                                Auto generate GS8
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="autoGenerateGS3" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Automatically generate GS3 event</h4>
                            </div>
                            <div class="modal-body">
                                <p>This action will generate a GS3 event.</p>
                                <p>These event can later be manually edited or removed at any time.</p>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ action('StudentsController@autoGenerateGS3', ['enrolment' => $student->enrolment]) }}" method="POST">
                                        <button class="btn btn-primary" type="submit">Add GS3 event</button>
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
                <div class="modal fade" id="autoGenerateGS5s" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Automatically generate all GS5 events</h4>
                            </div>
                            <div class="modal-body">
                                <p>This action will generate GS5 events every 12 months for the student's duration of study from their start date.</p>
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
                <div class="modal fade" id="autoGenerateGS5b" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Automatically generate GS5b event</h4>
                            </div>
                            <div class="modal-body">
                                <p>This action will generate a GS5b event.</p>
                                <p>These event can later be manually edited or removed at any time.</p>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ action('StudentsController@autoGenerateGS5b', ['enrolment' => $student->enrolment]) }}" method="POST">
                                        <button class="btn btn-primary" type="submit">Add GS5b event</button>
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
                <div class="modal fade" id="autoGenerateGS7" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Automatically generate GS7 event</h4>
                            </div>
                            <div class="modal-body">
                                <p>This action will generate a GS7 event.</p>
                                <p>These event can later be manually edited or removed at any time.</p>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ action('StudentsController@autoGenerateGS7', ['enrolment' => $student->enrolment]) }}" method="POST">
                                        <button class="btn btn-primary" type="submit">Add GS7 event</button>
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
                <div class="modal fade" id="autoGenerateGS8" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Automatically generate GS8 event</h4>
                            </div>
                            <div class="modal-body">
                                <p>This action will generate a GS8 event.</p>
                                <p>These event can later be manually edited or removed at any time.</p>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ action('StudentsController@autoGenerateGS8', ['enrolment' => $student->enrolment]) }}" method="POST">
                                        <button class="btn btn-primary" type="submit">Add GS8 event</button>
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
        <script type="text/javascript">
            $('#all_events_table').on( 'click', 'tbody tr', function () {
                window.location.href = $(this).attr('href');
            } );
            $(document).ready(function() {
                $('#all_events_table').dataTable( {
                    "order": [[ 3, "desc" ]],
                    "filter":   false,
                    "info":     false,
                    "paging":   true,
                    "lengthChange": false
                } );
            });
        </script>