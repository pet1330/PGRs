<!-- will be used to show any messages -->
@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! Session::get('success_message') !!}</div>
@endif
@if (Session::has('info_message'))
    <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! Session::get('info_message') !!}</div>
@endif
@if (Session::has('warning_message'))
    <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! Session::get('warning_message') !!}</div>
@endif
@if (Session::has('danger_message'))
    <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{!! Session::get('danger_message') !!}</div>
@endif