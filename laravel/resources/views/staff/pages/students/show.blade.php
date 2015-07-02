@extends('staff.layouts.default')
@section('title')
{{ $student->user->full_name }}@if ($student->end != null) <small><span class="label label-warning">Finished study / previous student</span></small>@endif
@endsection
@section('table_name', 'supervisors')
@section('content')
<div class="col-md-12 col-xs-12">
    @include('global.includes.show_alerts')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">History</div>
                <div class="panel-body">
                    <div class="horizontal-timeline">
                        <ul class="events">
                            <li style="width: 42.48%; left: 57.2%;">Design &amp; Typography <em>(2007 - 2009)</em></li>
                            <li style="width: 56.68%; left: 43%;">Photography <em>(2006 - 2009)</em></li>
                            <li style="width: 71.3%; left: 28.4%;">Object Oriented Programming <em>(2005 - 2009)</em></li>
                            <li style="width: 85.5%; left: 14.2%;">Web Development <em>(2004 - 2009)</em></li>
                            <li style="width: 42.75%; left: 0;">3D Modeling and Rendering <em>(2003 - 2006)</em></li>
                            <li style="width: 99.5%; left: 0;">Drawing &amp; Illustration <em>(2003 - 2009)</em></li>
                        </ul> <!-- end .events -->
                        <ul class="intervals">
                            <li class="first">2003</li>
                            <li>2004</li>
                            <li>2005</li>
                            <li>2006</li>
                            <li>2007</li>
                            <li>2008</li>
                            <li class="last">2009</li>
                        </ul> <!-- end .intervals -->
                    </div> <!-- end .timeline -->
                </div>
                {{-- <div class="panel-footer">
                    Panel Footer
                </div> --}}
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
                <div class="panel-heading">{{ $student->user->full_name }}'s supervisors</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#current_supervisors" data-toggle="tab" aria-expanded="true">Current <span class="badge">{{ $current_supervisors->count() }}</span></a>
                        </li>
                        <li class=""><a href="#previous_supervisors" data-toggle="tab" aria-expanded="false">Previous <span class="badge">{{ $previous_supervisors->count() }}</span></a>
                        </li>
                        <li class=""><a href="#all_supervisors" data-toggle="tab" aria-expanded="false">All <span class="badge">{{ $all_supervisors->count() }}</span></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="current_supervisors" aria-labelledby="current_supervisors-tab">
                            @if (count($current_supervisors->all()) > 0 )
                            <div class="table-responsive">
                                <table class="table table-hover" id="current_supervisors_table">
                                    <thead>
                                        <tr>
                                            <th>Supervisor</th>
                                            <th>Order</th>
                                            <th>Start</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($current_supervisors->all() as $supervisor)
                                        <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                            <td>{{ $supervisor->staff->user->full_name }}</td>
                                            <td>{{ $supervisor->order }}</td>
                                            <td>{{ $supervisor->start }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            This student does not have any current supervisors.
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="previous_supervisors" aria-labelledby="previous_supervisors-tab">
                            @if (count($previous_supervisors->all()) > 0 )
                            <div class="table-responsive">
                                <table class="table table-hover" id="previous_supervisors_table">
                                    <thead>
                                        <tr>
                                            <th>Supervisor</th>
                                            <th>Order</th>
                                            <th>Start</th>
                                            <th>End</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($previous_supervisors->all() as $supervisor)
                                        <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                            <td>{{ $supervisor->staff->user->full_name }}</td>
                                            <td>{{ $supervisor->order }}</td>
                                            <td>{{ $supervisor->start }}</td>
                                            <td>{{ $supervisor->end }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            This student does not have any previous supervisors.
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="all_supervisors" aria-labelledby="all_supervisors-tab">
                            @if (count($all_supervisors->all()) > 0 )
                            <div class="table-responsive">
                                <table class="table table-hover dataTable" id="all_supervisors_table">
                                    <thead>
                                        <tr>
                                            <th>Supervisor</th>
                                            <th>Order</th>
                                            <th>Start</th>
                                            <th>End</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_supervisors->all() as $supervisor)
                                        <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                            <td>{{ $supervisor->staff->user->full_name }}</td>
                                            <td>{{ $supervisor->order }}</td>
                                            <td>{{ $supervisor->start }}</td>
                                            <td>@if ($supervisor->end === null)<span class="label label-success">Current supervisor</span>@else{{ $supervisor->end }}@endif</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            This student does not have any supervisors.
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="btn-group">
                        <a class="btn btn-default" href="{{ action('SupervisorsController@createForStudent', ['enrolment' => $student->enrolment]) }}">Add new supervisor</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">GS form submissions</div>
                <div class="panel-body">
                    This student does not have any form submissions.
                </div>
                <div class="panel-footer">
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Add GS form</a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-default" href="">Manage existing submissions</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-clock-o fa-fw"></i> Events</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-badge"><i class="fa fa-check"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago</small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-badge info"><i class="fa fa-save"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                    <hr>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Action</a>
                                            </li>
                                            <li><a href="#">Another action</a>
                                            </li>
                                            <li><a href="#">Something else here</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#current_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#previous_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#all_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $(document).ready(function() {
        $('#current_supervisors_table').dataTable( {
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#previous_supervisors_table').dataTable( {
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#all_supervisors_table').dataTable( {
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
    } );
</script>
@endsection
@stop