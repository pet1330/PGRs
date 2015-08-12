<div class="panel panel-default">
    <div class="panel-heading">Students Currently Supervised</div>
    <!-- /.panel-heading -->
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
                                <th>Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myStudents_1->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->user->full_name }}</a></td>
                                <td>{{ $supervisor->start }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This staff member is not the Director of study for any students.
                @endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="2_supervisor" aria-labelledby="2_supervisor-tab">
                @if (count($myStudents_2->all()) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="2_supervisor_table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myStudents_2->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->user->full_name }}</a></td>
                                <td>{{ $supervisor->start }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This staff member is not the Second Supervisor for any students.
                @endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="3_supervisor" aria-labelledby="3_supervisor-tab">
                @if (count($myStudents_3->all()) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="3_supervisor_table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myStudents_3->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->user->full_name }}</a></td>
                                <td>{{ $supervisor->start }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This staff member is not the Third Supervisor for any students.
                @endif
            </div>
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