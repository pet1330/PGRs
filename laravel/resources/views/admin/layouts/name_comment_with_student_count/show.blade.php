@extends(Auth::user()->default_layout)
@section('title')
{{ $singleName }}: {{ $entity->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9">
    @include('global.includes.show_alerts')
    <table class="table table-single-entity">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $entity->name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $entity->description }}</td>
            </tr>
            <tr>
                <td>Number of students</td>
                <td>{{ $count = App\Student::EntityCount($tableName, $entity->id)->count() }}</td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action($controllerName.'@index') }}">View all {{ $pluralName }}</a>
    </div>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action($controllerName.'@edit', ['name' => $entity->name]) }}">Edit</a>
    </div>
    @if ($count > 0)
    <div class="btn-group">
        <button class="btn btn-danger disabled" data-toggle="modal" data-target="#delete">Delete</button>
    </div>
    @else
    <div class="btn-group">
        <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete {{ $singleName }}</h4>
                </div>
                <div class="modal-body">
                    This action removes this {{ $singleName }} and cannot be undone.
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="btn-group">
                        <form action="{{ action($controllerName.'@destroy', ['name' => $entity->name]) }}" method="POST">
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
@if ($count > 0)
<div class=" col-md-12 col-lg-12">
    <h2>Students</h2>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="all-students">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Enrolment number</th>
                    <th>Current year</th>
                    <th>Enrolment status</th>
                    <th>Award</th>
                    <th>Mode of study</th>
                    <th>Email</th>
                    <th>Supervisors</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Enrolment number</th>
                    <th>Current year</th>
                    <th>Enrolment status</th>
                    <th>Award</th>
                    <th>Mode of study</th>
                    <th>Email</th>
                    <th>Supervisors</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($students as $student)
                <tr class="clickable" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">
                    <td>{{ $student->user->full_name }}</td>
                    <td>{{ $student->enrolment }}</td>
                    <td>@if ($student->end == NULL){{ "Current" }}@elseif ($student->end != NULL && strtotime($student->end) < time()){{ "Completed" }}@else{{ $student->current_year }}@endif</td>
                    <td>{{ $student->enrolment_status->name }}</td>
                    <td>{{ $student->award->name }}</td>
                    <td>{{ $student->mode_of_study->name }}</td>
                    <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
                    <td>@if (count($student->supervisors->where('end', null)->all()) > 0)<ul class="list-unstyled" style="margin: 0">@foreach($student->supervisors->where('end', null)->all() as $supervisor)<li><small>{{ $supervisor->order }}</small> <a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}{!! '</a></li>' !!}@endforeach</ul>@else{{ 'None' }}@endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.table-responsive -->
    <script type="text/javascript">
        $(document).ready( function () {

        $('#all-students').DataTable({
        "iDisplayLength": 25,
        "order": [[ 1, "asc" ]],
        "iDisplayLength": 25,
    });

    // Setup - add a text input to each footer cell
    $('#all-students tfoot th').each( function () {
    var title = $('#all-students thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" placeholder="Filter" />' );
} );

// DataTable
var table = $('#all-students').DataTable();

// Apply the search
table.columns().every( function () {
var that = this;

$( 'input', this.footer() ).on( 'keyup change', function () {
that
.search( this.value )
.draw();
} );
} );

} );
$('#all-students').on( 'click', 'tbody tr', function () {
window.location.href = $(this).attr('href');
} );
</script>
</div>
@endif
@endsection
@stop