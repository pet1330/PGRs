@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Register for an account</h3>
        </div>
        <div class="panel-body">
            <form method="POST" action="/auth/register" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="form-group">
                        <input class="form-control" placeholder="Name" name="name" type="text" autofocus value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password">
                    </div>

                    <div class="form-group">
                        <input class="form-control" placeholder="Confirm password" name="password_confirmation" type="password">
                    </div>

                    <div>
                        <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
@stop