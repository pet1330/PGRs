<div class="panel panel-default">
    <div class="panel-heading">
        Profile
    </div>
    <div class="panel-body">
        <div class="container-fluid">
            <div class="row">
                @if ($student->user->image != NULL)
                <div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                    <img src="/userImages/{{ $student->user->image }}" alt="{{ $student->user->full_name }}" class="img-thumbnail">
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    @else<div class="col-md-12 col-sm-12 col-xs-12">
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $student->user->complete_name }}</td>
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
                                    <td>@if ($student->end === null)<span class="label label-success">Current student</span>@else{{ $student->end }}@endif</td>
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
                                    <td>Mode of study</td>
                                    <td><a href="{{ action('ModesOfStudyController@show', ['name' => $student->mode_of_study->name]) }}">{{ $student->mode_of_study->name }}</a></td>
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
            </div>
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