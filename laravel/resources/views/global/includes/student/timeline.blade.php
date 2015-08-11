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

//create groups
var groups = new vis.DataSet([
    @if (count($expected_events->all()) > 0 )
    {
        id: 1,
        content: 'Expected'
    },
    @endif
    @if ((count($submitted_events->all())+count($approved_events->all())) > 0 )
    {
        id: 2,
        content: 'Actual'
    },
    @endif
    ]);

// Create the event items
var items = new vis.DataSet([
    @if(count($all_absences) > 0)
    @foreach($all_absences->all() as $absence)
    {content:'{{ $absence->absence_type->name }}',
    start: '{{ $absence->start }}',
    end: '{{ $absence->end }}',
    type: 'background',
    className: 'absence'},
    @endforeach
    @endif
    @foreach ($expected_events->all() as $event)
    {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="{{ $event->gs_form->name }}<br>Created {{ Carbon\Carbon::parse($event->created_at)->toDateString() }}@if($event->start)<br>Expected start {{ $event->start }}@endif @if($event->end)<br>Expected end {{ $event->end }}@endif">{{ $event->gs_form->name }}</a>',
    group: 1,
    className: 'expected',
    start: '{{ $event->created_at }}'},
    @endforeach

    @foreach ($submitted_events->all() as $event)
    
    {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="{{ $event->gs_form->name }}<br>Submitted {{ $event->submitted_at }}">{{ $event->gs_form->name }}</a>',
    group: 2,
    className: 'submitted',
    start: '{{ $event->submitted_at }}'},

    @endforeach

    @foreach ($approved_events->all() as $event)

    {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="{{ $event->gs_form->name }}<br>Approved {{ $event->approved_at }}">{{ $event->gs_form->name }}</a>',
    group: 2,
    className: 'approved',
    start: '{{ $event->approved_at }}'},

    @endforeach
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
var timeline = new vis.Timeline(container);
timeline.setOptions(options);
timeline.setGroups(groups);
timeline.setItems(items);
</script>