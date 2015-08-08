<div class="panel panel-yellow">
    <div class="panel-heading">Upcoming events</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover dataTable" id="upcoming_events_table">
                <thead>
                    <tr>
                        <th>Form</th>
                        <th>Exp start</th>
                        <th>Time until start</th>
                        <th>Supervisors</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($upcoming_events->all() as $event)
                    <tr class="clickable" href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">
                        <td>{{ $event->gs_form->name }}</td>
                        <td>{{ $event->start }}</td>
                        <td>{{ Carbon\Carbon::parse($event->start)->diffForHumans() }}</td>
                        <td><ul class="list-unstyled" style="margin: 0">@if($event->directorOfStudy)<li><small>1</small> {{ $event->directorOfStudy->user->full_name }}</li>@endif
                            @if ($event->secondSupervisor)<li><small>2</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif
                            @if($event->thirdSupervisor)<li><small>3</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>