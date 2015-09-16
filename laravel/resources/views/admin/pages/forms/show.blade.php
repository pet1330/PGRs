@extends(Auth::user()->default_layout)
@section('title')
{{ $singleName }}: {{ $entity->name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 ">
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
                <td>Default start month</td>
                <td>{{ $entity->defaultStartMonth }}</td>
            </tr>
            <tr>
                <td>Approved date/time enabled</td>
                <td>@if($entity->approved_enabled)Yes @else No @endif</td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action($controllerName.'@index') }}">View all {{ $pluralName }}</a>
    </div>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action($controllerName.'@edit', ['id' => $entity->id]) }}">Edit</a>
    </div>
    @if($isInUse == false)
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
                        <form action="{{ action($controllerName.'@destroy', ['id' => $entity->id]) }}" method="POST">
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
    @else
    <button type="button" class="btn btn-danger disabled">Delete</button>
    @endif
</div>
@endsection
@stop