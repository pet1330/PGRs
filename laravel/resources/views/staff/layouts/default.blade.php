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
                        @if(isset($__env->getSections()['profile_image']))
                        <div style="float: left; margin-bottom: 1em;margin-right: 1em; margin-top: 1em;">
                            @yield('profile_image')
                        </div>
                        <h1 class="page-header">@if (isset($__env->getSections()['page_title']))@yield('page_title')@else @yield('title')@endif</h1>
                        @else
                        <h1 class="page-header">@if (isset($__env->getSections()['page_title']))@yield('page_title')@else @yield('title')@endif</h1>
                        @endif
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