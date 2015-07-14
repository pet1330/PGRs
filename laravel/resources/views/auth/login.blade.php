@extends('global.layouts.auth')
@section('title', 'Login')
@section('content')
<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Login</h3>
    </div>
    <div class="panel-body">
        @include('global.includes.show_errors')
        <form method="POST" action="/login" role="form">
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group input-group required">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="{{ old('email') }}">
                </div>
                <div class="form-group input-group required">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input class="form-control" placeholder="Password" name="password" type="password" id="password">
                </div>
                <div class="checkbox">
                    <label>
                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                    </label>
                </div>
                <div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </div>
                <div>
                    <a type="button" class="btn btn-link" href="/password/email">Forgot your password?</a>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection
@stop