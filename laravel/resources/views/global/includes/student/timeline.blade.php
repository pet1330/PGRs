@if (count($all_events->all()) > 0 )
<div class="col-md-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Event timeline
        </div>
        <div class="panel-body" style="padding: 0px;">
            <div id="event_timeline"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
// DOM element where the Timeline will be attached
var container = document.getElementById('event_timeline');

// Create a DataSet (allows two way data-binding)
var items = new vis.DataSet([
    @if (count($all_events->all()) > 0 )
    @foreach ($all_events->all() as $event)
    @if ($event->exp_start)
    {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">{{ $event->gs_form->name }}</a>', start: '{{ $event->exp_start }}' @if ($event->exp_end), end: '{{ $event->exp_end }}' @endif },
    @elseif ($event->approved_at)
    {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}">{{ $event->gs_form->name }}</a>', start: '{{ $event->approved_at }}'},
    @endif
    @endforeach
    @endif
    ]);

// Configuration for the Timeline
var options = {
    // clickToUse: true,
    selectable: false,
    min: new Date('{{ $student->start }}'),                // lower limit of visible range
    max: new Date('{{ $student->end }}'),                // upper limit of visible range
    zoomMin: 1000 * 60 * 60 * 24             // one day in milliseconds
};

// Create a Timeline
var timeline = new vis.Timeline(container, items, options);
</script>
@endif