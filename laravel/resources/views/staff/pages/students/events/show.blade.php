@extends('staff.layouts.default')
@section('title')
{{ $event->gs_form->name }} <small>{{ $event->gs_form->description }}</small> for {{ $event->student->user->full_name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 ">
    @include('global.includes.show_alerts')
    <table class="table table-user-information">
        <tbody>
            <tr>
                <td>Form code</td>
                <td>{{ $event->gs_form->name }}</td>
            </tr>
            <tr>
                <td>Form name</td>
                <td>{{ $event->gs_form->description }}</td>
            </tr>
            <tr>
                <td>Student</td>
                <td>{{ $event->student->user->full_name }}</td>
            </tr>
            <tr>
                <td>Submitted</td>
                <td>{{ $event->submitted_at }}</td>
            </tr>
            <tr>
                <td>Approved</td>
                <td>{{ $event->approved_at }}</td>
            </tr>
            <tr>
                <td>Expected start</td>
                <td>{{ $event->exp_start }}</td>
            </tr>
            <tr>
                <td>Expected end</td>
                <td>{{ $event->exp_end }}</td>
            </tr>
            <tr>
                <td>Comments</td>
                <td>{{ $event->comments }}</td>
            </tr>
            <tr>
                <td>Director of Study</td>
                <td>{{ $event->directorOfStudy->user->full_name }}</td>
            </tr>
            <tr>
                <td>Second supervisor</td>
                <td>{{ $event->secondSupervisor->user->full_name }}</td>
            </tr>
            <tr>
                <td>Third supervisor</td>
                <td>{{ $event->thirdSupervisor->user->full_name }}</td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('SupervisorsController@edit', ['id' => $event->id]) }}">Edit</a>
    </div>
    <div class="btn-group">
        <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete supervision record</h4>
                </div>
                <div class="modal-body">
                    This action removes this supervision record and cannot be undone.
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="btn-group">
                        <form action="{{ action('SupervisorsController@destroy', ['id' => $event->id]) }}" method="POST">
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
</div>
@endsection
@stop