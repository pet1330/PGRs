<div class="panel panel-default">
    <div class="panel-heading">Enrolment status history</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        @if (count($status_history->all()) > 0 )
        <div class="table-responsive">
            <table class="table table-hover dataTable" id="status_history_table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Date changed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($status_history->all() as $status_history_record)
                    <tr>
                        <td>{{ $status_history_record->enrolment_status->name }}</td>
                        <td>{{ $status_history_record->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        There is not any enrolment status history for this student
        @endif
    </div>
    <!-- /.panel-body -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#status_history_table').dataTable( {
            "order": [[ 1, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
    });
</script>