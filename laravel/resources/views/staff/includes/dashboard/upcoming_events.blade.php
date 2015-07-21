<div class="panel panel-yellow">
<div class="panel-heading">All upcoming events</div>
    <div class="panel-body">
        <table class="table table-hover dataTable" id="all_upcoming_events_table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Form</th>
                    <th>Exp start</th>
                    <th>Time until start</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_upcoming_events->all() as $event)
                <tr class="clickable" href="{{ action('EventsController@show', ['enrolment' => $event->student->enrolment, 'id' => $event->id]) }}">
                    <td><a href="{{ action('StudentsController@show', ['enrolment' => $event->student->enrolment]) }}">{{ $event->student->user->full_name }}</a></td>
                    <td>{{ $event->gs_form->name }}</td>
                    <td>{{ $event->exp_start }}</td>
                    <td>{{ Carbon\Carbon::parse($event->exp_start)->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>