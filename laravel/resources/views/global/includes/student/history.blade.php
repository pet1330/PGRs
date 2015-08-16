<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-clock-o fa-fw"></i> History</div>
    <!-- /.panel-heading -->
    <div class="panel-body" style="padding: 0 15px 0 0">
        @if (count($history->all()) > 0 )
        <ul class="timeline history">
            @if (Entrust::can('can_create_any_student_history') || (Entrust::can('can_create_my_students_history') && Auth::user()->staff->isMyStudent($student->id)))
            <li>
                <a class="timeline-badge primary" href="{{ action('HistoryController@create', ['enrolment' => $student->enrolment]) }}" data-toggle="tooltip" data-placement="right" title="" data-original-title="Add a new entry"><i class="fa fa-plus"></i>
                </a>
            </li>
            @endif
            @foreach ($history->all() as $single_history)
            <li @if(!$single_history->staff_id) class="automatic" id="{{ $single_history->id }}" @endif>
                <div class="timeline-badge"><i class="fa fa-pencil"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 class="timeline-title">{{ $single_history->title }}</h4>
                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ date('F d, Y', strtotime($single_history->created)) }} at {{ date("G:i",strtotime($single_history->created)) }}@if ($single_history->staff_id) by {{ $single_history->staff->user->full_name }}@elseif (!$single_history->staff_id) <span class="label label-info">Automated entry</span>@endif</small>
                        </p>
                    </div>
                    <div class="timeline-body"><p>{{ $single_history->content }}</p></div>
                    <div class="timeline-footer">
                        @if (Entrust::can('can_edit_any_student_history') || (Auth::user()->staff->isMyStudent($student->id) && ($single_history->staff_id == Auth::user()->staff->id) && Entrust::can('can_edit_my_students_history')))
                        <div class="btn-group">
                            <a class="btn btn-default btn-xs" href="{{ action('HistoryController@edit', ['enrolment' => $student->enrolment, 'id' => $single_history->id]) }}">Edit</a>
                        </div>
                        @endif
                        @if (Entrust::can('can_destroy_any_student_history') || (Auth::user()->staff->isMyStudent($student->id) && ($single_history->staff_id == Auth::user()->staff->id) && Entrust::can('can_destroy_my_student_history')))
                        <div class="btn-group">
                            <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteHistory{{ $single_history->id }}">Delete</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteHistory{{ $single_history->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Delete history entry</h4>
                                    </div>
                                    <div class="modal-body">
                                        This action will permanently delete this history item.
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="btn-group">
                                            <form action="{{ action('HistoryController@destroy', ['enrolment' => $student->enrolment, 'id' => $single_history->id]) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit">Delete</button>
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
        @if (Entrust::can('can_create_any_student_history') || (Entrust::can('can_create_my_students_history') && Auth::user()->staff->isMyStudent($student->id)))
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ action('HistoryController@create', ['enrolment' => $student->enrolment]) }}">Add new history entry</a>
        </div>
        @endif
        @if (count($history->all()) > 0)
        <div class="checkbox btn-group @if (Entrust::can('can_create_any_student_history') || (Entrust::can('can_create_my_students_history') && Auth::user()->staff->isMyStudent($student->id))) pull-right @endif">
            <label><input type="checkbox" id="cbxShowHideAutomated"> Show automated history</label>
        </div>
        @endif
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        removeAutoHistory(); 
    });
    $("#cbxShowHideAutomated").click(function() {
        if($(this).is(":checked"))
        {
            autoHistoryItemsCommented.forEach(function(autoHistory) {
                $(autoHistory).replaceWith(autoHistory.nodeValue);
            });
            $("ul.history").quickPagination();
        }
        else
            removeAutoHistory();     
    });
    function removeAutoHistory() {
        autoHistoryItemsCommented = [];
        var autoHistoryCollection = $("li.automatic");
        autoHistoryCollection.each(function(i, autoHistory){
            var id = $(autoHistory).attr('id');
            var my_element_jq = $('#' + id);
            autoHistoryItemsCommented[i] = document.createComment(my_element_jq.get(0).outerHTML);
            my_element_jq.replaceWith(autoHistoryItemsCommented[i]);
        });
        $("ul.history").quickPagination();
    }
</script>