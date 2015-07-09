<!DOCTYPE html>
<html lang="en">
<head>
    @include('global.includes.head')
</head>
<body>
    <div id="wrapper">
        @include('staff.includes.navigation')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 class="page-header">@yield('page_title')</h1>
                        @yield('content')
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    @include('global.includes.foot')
</body>
</html>