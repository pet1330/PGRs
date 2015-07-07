<div class="panel panel-default">
    <div class="panel-heading">GS form submissions</div>
    <div class="panel-body">
        @if (count($all_events->all()) > 0 )
        <div class="table-responsive">
            <table class="table table-hover dataTable" id="all_events_table">
                <thead>
                    <tr>
                        <th>Form</th>
                        <th>Exp start</th>
                        <th>Exp end</th>
                        <th>Submitted</th>
                        <th>Supervisors</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_events->all() as $event)
                    <tr class="clickable" href="">
                        <td>{{ $event->gs_form->name }}</td>
                        <td>{{ $event->exp_start }}</td>
                        <td>{{ $event->exp_end }}</td>
                        <td>{{ $event->submitted }}</td>
                        <td><ul class="list-unstyled" style="margin: 0"><li><small>Director of study</small> {{ $event->directorOfStudy->user->full_name }}</li>@if ($event->secondSupervisor != NULL)<li><small>Second supervisor</small> {{ $event->secondSupervisor->user->full_name }}</li>@endif @if($event->thirdSupervisor != NULL)<li><small>Third supervisor</small> {{ $event->thirdSupervisor->user->full_name }}</li>@endif</ul></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        This student does not have any form submissions.
        @endif
    </div>
    <div class="panel-footer">
        <div class="btn-group">
            <a class="btn btn-default" href="">Add GS form</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="">Manage existing submissions</a>
        </div>
    </div>
</div>