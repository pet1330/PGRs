<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-clock-o fa-fw"></i> History</div>
    <!-- /.panel-heading -->
    <div class="panel-body" style="padding: 0 15px 0 0">
        @if (count($history->all()) > 0 )
        <ul class="timeline">
            <li>
                <a class="timeline-badge primary" href="{{ action('HistoryController@create', ['enrolment' => $student->enrolment]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Add a new entry"><i class="fa fa-plus"></i>
                </a>
            </li>
            @foreach ($history->all() as $single_history)
            <li>
                <div class="timeline-badge"><i class="fa fa-pencil"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">{{ $single_history->title }}@if ($single_history->staff_id != NULL)<small> by {{ $single_history->staff->user->full_name }}</small>@elseif ($single_history->created_by == 'System') <span class="label label-info pull-right">Automated entry</span>@else<small> by{{ $single_history->created_by }}</small>@endif</h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ date('F d, Y', strtotime($single_history->created)) }} at {{ date("G:i",strtotime($single_history->created)) }}</small>
                        </p>
                    </div>
                    <div class="timeline-body"><p>{{ $single_history->content }}</p></div>
                    <div class="timeline-footer">
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs" href="{{ action('HistoryController@edit', ['enrolment' => $student->enrolment, 'id' => $single_history->id]) }}">Edit</a>
                        </div>
                        <div class="btn-group">
                            <form action="{{ action('HistoryController@destroy', ['enrolment' => $student->enrolment, 'id' => $single_history->id]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        @else
        <div style="padding: 15px">There aren't any history entries for this student yet.</div>
        @endif
    </div>
    <!-- /.panel-body -->
    <div class="panel-footer">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ action('HistoryController@create', ['enrolment' => $student->enrolment]) }}">Add new history entry</a>
        </div>
    </div>
</div>