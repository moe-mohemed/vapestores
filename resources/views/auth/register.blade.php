@extends('layout')

@section('content')
    <div class="page-title">
        <div class="contains">
            <h1>Register</h1>
        </div>
    </div>
    <div class="contains">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal reg-form" role="form" method="POST" action="{{ url('/register') }}">
                                {{ csrf_field() }}

                                <div class="input-field {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="input-field {{ $errors->has('username') ? ' has-error' : '' }}">
                                    <input id="name" type="text" class="form-control" name="username" value="{{ old('username') }}">
                                    <label for="username" class="col-md-4 control-label">Username</label>

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

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

                                <div class="input-field {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-field ">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="select-img" data-value="1.png">
                                            <img src="img/avatars/1.png">
                                        </div>
                                        <div class="select-img" data-value="2.png">
                                            <img src="img/avatars/2.png">
                                        </div>
                                        <div class="select-img" data-value="3.png">
                                            <img src="img/avatars/3.png">
                                        </div>
                                        <div class="select-img" data-value="4.png">
                                            <img src="img/avatars/4.png">
                                        </div>
                                        <div class="select-img" data-value="5.png">
                                            <img src="img/avatars/5.png">
                                        </div>
                                        <div class="select-img" data-value="6.png">
                                            <img src="img/avatars/6.png">
                                        </div>
                                        <div class="select-img" data-value="7.png">
                                            <img src="img/avatars/7.png">
                                        </div>
                                        <div class="select-img" data-value="8.png">
                                            <img src="img/avatars/8.png">
                                        </div>
                                        <div class="select-img" data-value="9.png">
                                            <img src="img/avatars/9.png">
                                        </div>
                                        <div class="select-img" data-value="10.png">
                                            <img src="img/avatars/10.png">
                                        </div>
                                        <input type="hidden" name="avatar" id="avatar" class="form-control avatar-value" value="{{ old('avatar') }}">
                                    </div>
                                </div>
                                <div class="input-field ">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-user"></i> Register
                                        </button>
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
