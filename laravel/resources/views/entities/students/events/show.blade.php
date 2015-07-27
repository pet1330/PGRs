@extends(Auth::user()->default_layout)
@section('title')
{{ $event->gs_form->name }} <small>{{ $event->gs_form->description }}</small>
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
                <td><a href="{{ action('StudentsController@show', ['enrolment' => $event->student->enrolment]) }}">{{ $event->student->user->full_name }}</a></td>
            </tr>
            <tr>
                <td>Created</td>
                <td>{{ $event->created_at }}</td>
            </tr>
            <tr>
                <td>Submitted</td>
                <td>{{ $event->submitted_at }}</td>
            </tr>
            <tr>
                <td>Approved</td>
                <td>{{ $event->approved_at }}</td>
            </tr>
            @if ($event->exp_start)
            <tr>
                <td>Expected start</td>
                <td>{{ $event->exp_start }}</td>
            </tr>
            @endif
            @if ($event->exp_end)
            <tr>
                <td>Expected end</td>
                <td>{{ $event->exp_end }}</td>
            </tr>
            @endif
            <tr>
                <td>Comments</td>
                <td>{{ $event->comments }}</td>
            </tr>
            <tr>
                <td>Director of Study</td>
                <td><a href="{{ action('StaffController@show', ['id' => $event->directorOfStudy->id]) }}">{{ $event->directorOfStudy->user->full_name }}</a></td>
            </tr>
            @if ($event->secondSupervisor)
            <tr>
                <td>Second supervisor</td>
                <td><a href="{{ action('StaffController@show', ['id' => $event->secondSupervisor->id]) }}">{{ $event->secondSupervisor->user->full_name }}</a></td>
            </tr>
            @endif
            @if ($event->thirdSupervisor)
            <tr>
                <td>Third supervisor</td>
                <td><a href="{{ action('StaffController@show', ['id' => $event->thirdSupervisor->id]) }}">{{ $event->thirdSupervisor->user->full_name }}</a></td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $event->student->enrolment]) }}">Cancel</a>
    </div>
    @if (Entrust::can('can_edit_gs_form_event'))
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('EventsController@edit', ['enrolment' => $event->student->enrolment, 'id' => $event->id]) }}">Edit</a>
    </div>
    @endif
    @if (Entrust::can('can_destroy_gs_form_event'))
    <div class="btn-group">
        <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete event record</h4>
                </div>
                <div class="modal-body">
                    This action will remove this event, it will also be removed from the student's timeline. It cannot be undone.
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="btn-group">
                        <form action="{{ action('EventsController@destroy', ['enrolment' => $event->student->enrolment, 'id' => $event->id]) }}" method="POST">
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
@endsection
@stop