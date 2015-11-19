<div class="panel panel-default">
    <div class="panel-heading">
        Profile
    </div>
    <div class="panel-body">
        <div class="container-fluid">
            <div class="row">
                @if ($student->user->image)
                <div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                    <img src="/userImages/{{ $student->user->image }}" alt="{{ $student->user->full_name }}" class="img-thumbnail">
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    @else<div class="col-md-12 col-sm-12 col-xs-12">
                    @endif
                    <div class="table-responsive">
                        <table class="table user-profile">
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
                                @if($student->user->personal_email)
                                @if(Entrust::hasRole('admin') || Auth::user()->isMyProfile($student->user->id) || Auth::user()->staff->isMyStudent($student->id))
                                <tr>
                                    <td>Personal/other email</td>
                                    <td><a href="mailto:{{ $student->user->personal_email }}">{{ $student->user->personal_email }}</a></td>
                                </tr>
                                @endif
                                @endif
                                @if($student->user->personal_phone)
                                @if(Entrust::hasRole('admin') || Auth::user()->isMyProfile($student->user->id)  || Auth::user()->staff->isMyStudent($student->id))
                                <tr>
                                    <td>Phone</td>
                                    <td><a href="tel:{{ $student->user->personal_phone }}">{{ $student->user->personal_phone }}</a></td>
                                </tr>
                                @endif
                                @endif
                                @if($student->gender)
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                @endif
                                @if(Entrust::hasRole('admin') || Auth::user()->isMyProfile($student->user->id)  || Auth::user()->staff->isMyStudent($student->id))
                                <tr>
                                    <td>Home address</td>
                                    <td>{{ $student->home_address }}</td>
                                </tr>
                                @endif
                                @if($student->current_address)
                                @if(Entrust::hasRole('admin') || Auth::user()->isMyProfile($student->user->id)  || Auth::user()->staff->isMyStudent($student->id))
                                <tr>
                                    <td>Current address</td>
                                    <td>{{ $student->current_address }}</td>
                                </tr>
                                @endif
                                @endif
                                @if($student->nationality)
                                @if(Entrust::hasRole('admin') || Auth::user()->isMyProfile($student->user->id)  || Auth::user()->staff->isMyStudent($student->id))
                                <tr>
                                    <td>Nationality</td>
                                    <td>{{ $student->nationality }}</td>
                                </tr>
                                @endif
                                @endif
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
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('UKBAStatusController@show', ['name' => $student->ukba_status->name]) }}">@endif{{ $student->ukba_status->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Funding type</td>
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('FundingTypesController@show', ['name' => $student->funding_type->name]) }}">@endif{{ $student->funding_type->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Course</td>
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('CoursesController@show', ['name' => $student->course->name]) }}">@endif{{ $student->course->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Award</td>
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('AwardsController@show', ['name' => $student->award->name]) }}">@endif{{ $student->award->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Mode of study</td>
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('ModesOfStudyController@show', ['name' => $student->mode_of_study->name]) }}">@endif{{ $student->mode_of_study->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                <tr>
                                    <td>Enrolment status</td>
                                    <td>@if(Entrust::hasRole('admin'))<a href="{{ action('EnrolmentStatusController@show', ['name' => $student->enrolment_status->name]) }}">@endif{{ $student->enrolment_status->name }}@if(Entrust::hasRole('admin'))</a>@endif</td>
                                </tr>
                                @if(Entrust::hasRole('admin'))
                                <tr @if($student->user->locked == '1') class="danger" @endif>
                                    <td>Account login disabled</td>
                                    <td>{{ ($student->user->locked ? 'Yes' : 'No') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Entrust::can('can_reset_user_password') || Entrust::can('can_edit_student') || Entrust::can('can_recalculate_student_end_date') || Entrust::can('can_destroy_student') || Entrust::can('can_destroy_student'))
    <div class="panel-footer">
        @if (Entrust::can('can_reset_user_password'))
        <div class="btn-group">
            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#resetPassword">Reset password</a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Reset user's password</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['action' => 'UserController@setPassword']) !!}
                        <fieldset>
                            <div class="form-group required @if ($errors->has('newPassword')) has-error @endif">
                                {!! Form::label('Password') !!}
                                {!! Form::password('newPassword', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('newPassword')) <p class="help-block">{{ $errors->first('newPassword') }}</p> @endif
                            </div>
                            <div class="form-group required @if ($errors->has('repeatNewPassword')) has-error @endif">
                                {!! Form::label('Repeat password') !!}
                                {!! Form::password('repeatNewPassword', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::hidden('userId', $student->user->id) !!}
                            <div class="btn-group">
                                {!! Form::submit('Update password', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        @endif
        @if (Entrust::can('can_edit_student'))
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@edit', ['enrolment' => $student->enrolment]) }}">Edit profile</a>
        </div>
        @endif
        @if (Entrust::can('can_recalculate_student_end_date'))
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@recalculateEndDate', ['enrolment' => $student->enrolment]) }}">@if (!$student->end) Calculate end date @else Recalculate end date @endif</a>
        </div>
        @endif
        @if (Entrust::can('can_destroy_student'))
        <div class="btn-group">
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteStudent">Delete account</a>
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
        @endif
    </div>
    @endif
</div>