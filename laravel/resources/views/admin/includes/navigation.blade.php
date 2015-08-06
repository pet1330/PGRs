<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><i class="fa fa-graduation-cap"></i> Postgraduate Management System</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{ Auth::user()->full_name }} <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="/profile"><i class="fa fa-user fa-fw"></i> My Profile</a>
                </li>
                {{-- <li><a href="/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li> --}}
            <li class="divider"></li>
            <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="/">Dashboard</a>
            </li>
            <li>
                <a href="{{ action('StudentsController@index') }}">All Students</a>
            </li>
            <li>
                <a href="{{ action('EventsController@upcomingIndex') }}">All Upcoming Events</a>
            </li>
            <li>
                <a href="{{ action('StaffController@index') }}">All Staff</a>
            </li>
            <li>
                <a href="/reports">Reports</a>
            </li>
            <li>
                <a href="/import">Import</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-cog fa-fw"></i> Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                    <li>
                        <a href="{{ action('SettingsController@index') }}">Global Settings</a>
                    </li>
                    <li>
                        <a href="#">User Management <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse">
                            <li>
                                <a href="{{ action('RolesController@index') }}">Roles</a>
                            </li>
                            <li>
                                <a href="{{ action('PermissionsController@index') }}">Permissions</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                    <li>
                        <a href="#">Student Attributes <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse">
                            <li>
                                <a href="{{ action('FundingTypesController@index') }}">Funding Types</a>
                            </li>
                            <li>
                                <a href="{{ action('AbsenceTypesController@index') }}">Absence Types</a>
                            </li>
                            <li>
                                <a href="{{ action('AwardsController@index') }}">Awards</a>
                            </li>
                            <li>
                                <a href="{{ action('ModesOfStudyController@index') }}">Modes of Study</a>
                            </li>
                            <li>
                                <a href="{{ action('EnrolmentStatusController@index') }}">Enrolment Status</a>
                            </li>
                            <li>
                                <a href="{{ action('CoursesController@index') }}">Course</a>
                            </li>
                            <li>
                                <a href="{{ action('UKBAStatusController@index') }}">UKBA Status</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>  
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>