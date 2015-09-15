<div class="panel panel-default">
    <div class="panel-heading">
        Profile
    </div>
    <div class="panel-body">
        <div class="container-fluid">
            <div class="row">
                @if ($staff->user->image)
                <div class="col-md-3 col-md-offset-0 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                    <img src="/userImages/{{ $staff->user->image }}" alt="{{ $staff->user->full_name }}" class="img-thumbnail">
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    @else<div class="col-md-12 col-sm-12 col-xs-12">
                    @endif
                    <div class="table-responsive">
                        <table class="table user-profile">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $staff->user->complete_name }}</td>
                                </tr>
                                <tr>
                                    <td>Account email</td>
                                    <td><a href="mailto:{{ $staff->user->email }}">{{ $staff->user->email }}</a></td>
                                </tr>
                                @if(Entrust::hasRole('admin') || Auth::user()->staff->id == $staff->id)
                                @if($staff->user->personal_email)
                                <tr>
                                    <td>Personal/other email</td>
                                    <td><a href="mailto:{{ $staff->user->personal_email }}">{{ $staff->user->personal_email }}</a></td>
                                </tr>
                                @endif
                                @endif
                                @if($staff->university_phone)
                                <tr>
                                    <td>University Phone</td>
                                    <td><a href="tel:{{ $staff->university_phone }}">{{ $staff->university_phone }}</a></td>
                                </tr>
                                @endif
                                @if(Entrust::hasRole('admin') || Auth::user()->staff->id == $staff->id)
                                @if($staff->user->personal_phone)
                                <tr>
                                    <td>Personal Phone</td>
                                    <td><a href="tel:{{ $staff->user->personal_phone }}">{{ $staff->user->personal_phone }}</a></td>
                                </tr>
                                @endif
                                @endif
                                @if($staff->position)
                                <tr>
                                    <td>Position</td>
                                    <td>{{ $staff->position }}</td>
                                </tr>
                                @endif
                                @if($staff->room)
                                <tr>
                                    <td>Room number</td>
                                    <td>{{ $staff->room }}</td>
                                </tr>
                                @endif
                                @if($staff->about)
                                <tr>
                                    <td>About</td>
                                    <td>{{ $staff->about }}</td>
                                </tr>
                                @endif
                                @if(Entrust::hasRole('admin'))
                                <tr @if ($staff->user->locked == '1') class="danger" @endif>
                                    <td>Account login disabled</td>
                                    <td>{{ ($staff->user->locked ? 'Yes' : 'No') }}</td>
                                </tr>
                                <tr>
                                    <td>Roles</td>
                                    <td><ul>@foreach($staff->user->roles as $role)<li>{{ $role->display_name }}</li>@endforeach</ul></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        @if (Entrust::can('can_reset_user_password'))
        <div class="btn-group">
            <a class="btn btn-default" href="">Reset password</a>
        </div>
        @endif
        @if (Entrust::can('can_edit_staff') || (Entrust::can('can_edit_own_profile') && (Auth::user()->staff->id == $staff->id)))
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StaffController@edit', ['id' => $staff->id]) }}">Edit</a>
        </div>
        @endif
        @if (Entrust::can('can_destroy_staff'))
        <div class="btn-group">
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteStaff">Delete</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteStaff" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Delete staff account</h4>
                    </div>
                    <div class="modal-body">
                        This action removes the entire staff profile and cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        <div class="btn-group">
                            <form action="{{ action('StaffController@destroy', ['id' => $staff->id]) }}" method="POST">
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
        @endif
    </div>
</div>