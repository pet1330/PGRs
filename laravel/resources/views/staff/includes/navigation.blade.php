<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Postgraduate Management System</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="/details"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                    <a href="{{ action('StudentsController@index') }}">Students</a>
                </li>
                <li>
                    <a href="{{ action('StaffController@index') }}">Staff</a>
                </li>
                <li>
                    <a href="/staff/events">Events</a>
                </li>
                <li>
                    <a href="/staff/supervisors">Supervisors</a>
                </li>
                <li>
                    <a href="/staff/reports">Reports</a>
                </li>
                <li>
                    <a href="/staff/history">History</a>
                </li>
                <li>
                    <a href="/staff/gs_forms">GS Forms</a>
                </li>
                <li>
                    <a href="{{ action('FundingController@index') }}">Funding</a>
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
                    <a href="{{ action('EnrolmentStatusController@index') }}">Enrolment Status'</a>
                </li>
                <li>
                    <a href="/staff/course">Course</a>
                </li>
                <li>
                    <a href="/staff/uk_ba_status">UK/BA Status</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>