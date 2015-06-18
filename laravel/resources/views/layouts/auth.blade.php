<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @yield('content')
            </div>
        </div>
    </div>
    @include('includes.foot')
</body>
</html>