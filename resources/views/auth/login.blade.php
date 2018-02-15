@extends('layout')

@section('content')
    <div class="page-title">
        <div class="contains">
            <h1>Login</h1>
        </div>
    </div>
    <div class="contains">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 login-pg">
                    <div class="panel panel-default">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif
                        <div class="panel-body">
                            <form class="form-horizontal login-form" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-field {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-field">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="input-field ">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i> Login
                                        </button>
                                        <div class="forgot-pwd">
                                            <a class="" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
