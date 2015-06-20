@extends('global.layouts.auth')
@section('title', 'Reset your password')
@section('content')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reset your password</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="/password/email" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="{{ old('email') }}">
                    </div>

                    <div>
                        <button class="btn btn-lg btn-success btn-block" type="submit">Send password reset link</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
@stop