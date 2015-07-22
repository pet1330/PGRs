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
@if (count($draft_events->all()) > 0 )
{
    id: 1,
    content: 'Draft'
},
@endif
@if (count($submitted_events->all()) > 0 )
{
    id: 2,
    content: 'Submitted'
},
@endif
@if (count($approved_events->all()) > 0 )
{
    id: 3,
    content: 'Approved'
}
@endif
]);

// Create the event items
var items = new vis.DataSet([
    @foreach ($draft_events->all() as $event)
        @if ($event->exp_start)

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Created {{ $event->created_at }}<br>Expected start {{ $event->exp_start }}@if ($event->exp_end)<br>Expected end {{ $event->exp_end }} @endif">{{ $event->gs_form->name }}</a>',
            group: 1,
            className: 'draft',
            start: '{{ $event->exp_start }}'
            @if ($event->exp_end), end: '{{ $event->exp_end }}' @endif
            },

        @else

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Created {{ $event->created_at }}">{{ $event->gs_form->name }}</a>',
            group: 1,
            className: 'draft',
            start: '{{ $event->created_at }}'},

        @endif
    @endforeach

    @foreach ($submitted_events->all() as $event)

        @if ($event->exp_start)

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Submitted {{ $event->submitted_at }}<br>Expected start {{ $event->exp_start }}@if ($event->exp_end)<br>Expected end {{ $event->exp_end }} @endif">{{ $event->gs_form->name }}</a>',
            group: 2,
            className: 'submitted',
            start: '{{ $event->exp_start }}'
            @if ($event->exp_end), end: '{{ $event->exp_end }}' @endif
            },

        @else

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Submitted {{ $event->submitted_at }}">{{ $event->gs_form->name }}</a>',
            group: 2,
            className: 'submitted',
            start: '{{ $event->submitted_at }}'},

        @endif

    @endforeach

    @foreach ($approved_events->all() as $event)

        @if ($event->exp_start)

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Approved {{ $event->approved_at }}<br>Expected start {{ $event->exp_start }}@if ($event->exp_end)<br>Expected end {{ $event->exp_end }} @endif">{{ $event->gs_form->name }}</a>',
            group: 3,
            className: 'approved',
            start: '{{ $event->exp_start }}'
            @if ($event->exp_end), end: '{{ $event->exp_end }}' @endif
            },

        @else

            {content: '<a href="{{ action('EventsController@show', ['enrolment' => $student->enrolment, 'id' => $event->id]) }}" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="Approved {{ $event->approved_at }}">{{ $event->gs_form->name }}</a>',
            group: 3,
            className: 'approved',
            start: '{{ $event->approved_at }}'},

        @endif

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