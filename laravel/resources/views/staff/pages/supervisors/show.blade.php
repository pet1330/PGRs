@extends('staff.layouts.default')
@section('title')
{{ $supervisor->staff->user->full_name }} supervising {{ $supervisor->student->user->full_name }}
@endsection
@section('content')
<div class=" col-md-9 col-lg-9 ">
    @include('global.includes.show_alerts')
    <table class="table table-user-information">
        <tbody>
            <tr>
                <td>Staff</td>
                <td><a href="">{{ $supervisor->staff->user->full_name }}</a></td>
            </tr>
            <tr>
                <td>Student</td>
                <td><a href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">{{ $supervisor->student->user->full_name }}</a></td>
            </tr>
            <tr>
                <td>Order</td>
                <td>{{ $supervisor->order }}</td>
            </tr>
            <tr>
                <td>Start date</td>
                <td>{{ $supervisor->start }}</td>
            </tr>
            <tr>
                <td>End date</td>
                <td>@if ($supervisor->end === null)<span class="label label-success">Current supervisor</span>@else{{ $supervisor->end }}@endif</td>
            </tr>
        </tbody>
    </table>
    <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $supervisor->student->enrolment]) }}">Cancel</a>
        </div>
    <div class="btn-group">
        <a class="btn btn-default" href="{{ action('SupervisorsController@edit', ['id' => $supervisor->id]) }}">Edit</a>
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
                        <form action="{{ action('SupervisorsController@destroy', ['id' => $supervisor->id]) }}" method="POST">
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