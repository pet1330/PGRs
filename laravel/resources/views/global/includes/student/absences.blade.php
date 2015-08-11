<div class="panel panel-default">
    <div class="panel-heading">Absences</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        @if(count($all_absences) > 0)
        <div class="table-responsive">
            <table class="table table-hover dataTable" id="absences_table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Start</th>
                        <th>End</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_absences->all() as $absence)
                    <tr class="clickable" href="{{ action('AbsencesController@show', ['enrolment' => $student->enrolment, 'id' => $absence->id]) }}">
                        <td>{{ $absence->absence_type->name }}</a></td>
                        <td>{{ Carbon\Carbon::parse($absence->start)->diffInDays(Carbon\Carbon::parse($absence->end)) }} days</td>
                        <td>{{ Carbon\Carbon::parse($absence->start)->toDateString() }}</td>
                        <td>{{ Carbon\Carbon::parse($absence->end)->toDateString() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        This student does not have any absences.
        @endif
    </div>
    <!-- /.panel-body -->
    @if (Entrust::can('can_create_absence_record'))
    <div class="panel-footer">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ action('AbsencesController@create', ['enrolment' => $student->enrolment]) }}">Add new absence</a>
        </div>
    </div>
    @endif
</div>
<script type="text/javascript">
    $('#absences_table').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $(document).ready(function() {
        $('#absences_table').dataTable( {
            "order": [[ 2, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
    } );
</script>