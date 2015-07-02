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
                {{ Auth::user()->title.' ' }}{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{-- <li>Welcome {{ $name = \Auth::user()->first_name }}</li> --}}
                <li><a href="/details"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    <a href="{{ action('StudentsController@index') }}">All Students</a>
                </li>
                <li>
                    <a href="{{ action('StaffController@index') }}">All Staff</a>
                </li>
                {{-- <li>
                    <a href="/staff/events">Events</a>
                </li> --}}
                <li>
                    <a href="{{ action('SupervisorsController@index') }}">All Supervisors</a>
                </li>
                {{-- <li>
                    <a href="/staff/reports">Reports</a>
                </li>
                <li>
                    <a href="/staff/history">History</a>
                </li>
                <li>
                    <a href="/staff/gs_forms">GS Forms</a>
                </li> --}}
                <li class="">
                    <a href="#"><i class="fa fa-cog fa-fw"></i> Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
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
                            <a href="{{ action('AwardTypesController@index') }}">Award Types</a>
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
                    <!-- /.nav-second-level -->
                </li>  
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>