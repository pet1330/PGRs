@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="/auth/login" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" id="password">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                        </label>
                    </div>

                    <div>
                        <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
@stop