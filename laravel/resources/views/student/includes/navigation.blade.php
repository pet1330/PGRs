<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/student">Postgraduate Management System</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{ Auth::user()->full_name }} <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{-- <li><a href="/student/details"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="/student/settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                    <a href="/student/timeline"><i class="glyphicon glyphicon-time"></i> Study Timeline</a>
                </li>
                <li>
                    <a href="/student/details"><i class="fa fa-user fa-fw"></i> Personal Details</a>
                </li>
                <li>
                    <a href="/student/supervisor"><i class="glyphicon glyphicon-education"></i> Supervisor Information</a>
                </li>
                <li>
                    <a href="/student/gs_forms"><i class="glyphicon glyphicon-edit"></i> GS Forms</a>
                </li>
                <li>
                    <a href="/student/history"><i class="fa fa-history fa-fw"></i> History</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>