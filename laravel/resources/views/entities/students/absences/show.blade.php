@extends(Auth::user()->default_layout)
@section('title')
{{ $absence->absence_type->name }} absence record for {{ $absence->student->user->full_name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 ">
    @include('global.includes.show_alerts')
    <table class="table table-user-information">
        <tbody>
            <tr>
                <td>Absence Type</td>
                <td>{{ $absence->absence_type->name }}</td>
            </tr>
            <tr>
                <td>Absence Type Description</td>
                <td>{{ $absence->absence_type->description }}</td>
            </tr>
            <tr>
                <td>Student</td>
                <td><a href="{{ action('StudentsController@show', ['enrolment' => $absence->student->enrolment]) }}">{{ $absence->student->user->full_name }}</a></td>
            </tr>
            <tr>
                <td>Start</td>
                <td>{{ $absence->start }}</td>
            </tr>
            <tr>
                <td>End</td>
                <td>{{ $absence->end }}</td>
            </tr>
            <tr>
                <td>Duration</td>
                <td>{{ Carbon\Carbon::parse($absence->start)->diffInDays(Carbon\Carbon::parse($absence->end)) }} days</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $absence->description }}</td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $absence->student->enrolment]) }}">Cancel</a>
    </div>
    @if (Entrust::can('can_edit_absence_record'))
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('AbsencesController@edit', ['enrolment' => $absence->student->enrolment, 'id' => $absence->id]) }}">Edit</a>
    </div>
    @endif
    @if (Entrust::can('can_destroy_absence_record'))
    <div class="btn-group">
        <button class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Delete absence record</h4>
                </div>
                <div class="modal-body">
                    This action will remove this absence, it will also be removed from the student's timeline. It cannot be undone.
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="btn-group">
                        <form action="{{ action('AbsencesController@destroy', ['enrolment' => $absence->student->enrolment, 'id' => $absence->id]) }}" method="POST">
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