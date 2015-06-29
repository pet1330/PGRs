@extends('staff.layouts.default')
@section('title')
{{ $student->user->first_name}} {{ $student->user->last_name }}
@endsection
@section('content')
<div class="col-md-12 col-xs-12">
    @include('global.includes.show_alerts')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Time line
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                </div>
                <div class="panel-footer">
                    Panel Footer
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $student->user->title.' ' }}{{ $student->user->first_name }}{{ ' '.$student->user->middle_name }} {{ $student->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Student ID number</td>
                                    <td>{{ $student->enrolment }}</td>
                                </tr>
                                <tr>
                                    <td>Account email</td>
                                    <td><a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></td>
                                </tr>
                                <tr>
                                    <td>Personal/other email</td>
                                    <td><a href="mailto:{{ $student->user->personal_email }}">{{ $student->user->personal_email }}</a></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><a href="tel:{{ $student->user->personal_phone }}">{{ $student->user->personal_phone }}</a></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Home address</td>
                                    <td>{{ $student->home_address }}</td>
                                </tr>
                                <tr>
                                    <td>Current address</td>
                                    <td>{{ $student->current_address }}</td>
                                </tr>
                                <tr>
                                    <td>Nationality</td>
                                    <td>{{ $student->nationality }}</td>
                                </tr>
                                <tr>
                                    <td>Start date</td>
                                    <td>{{ $student->start }}</td>
                                </tr>
                                <tr>
                                    <td>End date</td>
                                    <td>{{ $student->end }}</td>
                                </tr>
                                <tr>
                                    <td>UKBA status</td>
                                    <td><a href="{{ action('UKBAStatusController@show', ['name' => $student->ukba_status->name]) }}">{{ $student->ukba_status->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Funding type</td>
                                    <td><a href="{{ action('FundingTypesController@show', ['name' => $student->funding_type->name]) }}">{{ $student->funding_type->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Course</td>
                                    <td><a href="{{ action('CoursesController@show', ['name' => $student->course->name]) }}">{{ $student->course->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Award</td>
                                    <td><a href="{{ action('AwardsController@show', ['name' => $student->award->name]) }}">{{ $student->award->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Award type</td>
                                    <td><a href="{{ action('AwardTypesController@show', ['name' => $student->award_type->name]) }}">{{ $student->award_type->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Enrolment status</td>
                                    <td><a href="{{ action('EnrolmentStatusController@show', ['name' => $student->enrolment_status->name]) }}">{{ $student->enrolment_status->name }}</a></td>
                                </tr>
                                <tr @if ($student->user->locked == '1') class="danger" @endif>
                                    <td>Account login disabled</td>
                                    <td>{{ ($student->user->locked ? 'Yes' : 'No') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Reset password</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default" href="{{ action('StudentsController@edit', ['enrolment' => $student->enrolment]) }}">Edit</a>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteStudent">Delete</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteStudent" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Delete student account</h4>
                                </div>
                                <div class="modal-body">
                                    This action removes the entire student profile and cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    <div class="btn-group">
                                        <form action="{{ action('StudentsController@destroy', ['enrolment' => $student->enrolment]) }}" method="POST">
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
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    History
                </div>
                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                </div>
                <div class="panel-footer">
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Add event</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Supervisors
                </div>
                <div class="panel-body">
                    @if (count($supervisors->all()) > 0 )
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Supervisor</th>
                                    <th>Order</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supervisors->all() as $supervisor)
                                <tr>
                                    <td>{{ $supervisor->staff->user->title.' ' }}{{ $supervisor->staff->user->first_name }} {{ $supervisor->staff->user->last_name }}</td>
                                    <td>{{ $supervisor->order }}</td>
                                    <td>{{ $supervisor->start }}</td>
                                    <td>{{ $supervisor->end }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    This student does not have any supervisors.
                    @endif
                </div>
                <div class="panel-footer">
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Add new supervisor</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Manage supervisors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@stop