@extends(Auth::user()->default_layout)
@section('title')
{{ $singleName }}: {{ $entity->display_name }}
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
                <td>Display name</td>
                <td>{{ $entity->display_name }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $entity->description }}</td>
            </tr>
            <tr>
                <td>Permissions</td>
                <td>@if(count($permissions) > 0)<ul>@foreach($permissions as $permission)<li>{{ $permission->display_name }}</li>@endforeach</ul>@else No permissions enabled.@endif</td>
            </tr>
            <tr>
                <td>Number of users with this role</td>
                <td>{{ $count = App\Role::find($entity->id)->users()->count() }}</td>
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
    <h2>Users</h2>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="all-users">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User's current roles</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User's current roles</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr class="clickable" href="{{ $user->link_to_user }}">
                    <td>{{ $user->full_name }}</td>
                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    <td><ul>@foreach($user->roles as $role)<li>{{ $role->display_name }}</li>@endforeach</ul></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.table-responsive -->
    <script type="text/javascript">
        $(document).ready( function () {

            $('#all-users').DataTable({
                "iDisplayLength": 25,
                "order": [[ 0, "asc" ]],
                "iDisplayLength": 25,
            });

// Setup - add a text input to each footer cell
$('#all-users tfoot th').each( function () {
    var title = $('#all-users thead th').eq( $(this).index() ).text();
    $(this).html( '<input type="text" placeholder="Filter" />' );
} );

// DataTable
var table = $('#all-users').DataTable();

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
        $('#all-users').on( 'click', 'tbody tr', function () {
            window.location.href = $(this).attr('href');
        } );
    </script>
</div>
@endif
@endsection
@stop