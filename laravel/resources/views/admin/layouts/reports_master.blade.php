<!DOCTYPE html>
<html lang="en">
<head>
    @include('global.includes.head')
</head>
<body>
    <div id="wrapper">
        @include('admin.includes.navigation')
        <!-- Page Content -->
        <div id="page-wrapper" style="padding: 0px">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    @include('global.includes.foot')
</body>
</html>