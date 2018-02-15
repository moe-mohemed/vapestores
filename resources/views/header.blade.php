<div class="navage">
    <div class="mobile-logo">
        <a href="/"><img src="/img/logo-mobile.png"></a>
    </div>
    <div class="contains cf">
        <!-- Right Side Of Navbar -->
        <ul class="navage-right">
            <!-- Authentication Links -->
            <li class="search-popup dropdown-button" data-activates="search-dropdown"><i class="fa fa-search" aria-hidden="true"></i>

            </li>
            @if (Auth::guest())
                <li><span class='dropdown-button login-btn' data-activates='login-dropdown'>Login</span></li>
                <li class="reg-btn"><span>Register</span></li>
                <li id="login-dropdown" class='dropdown-content login-popup prevent-def'>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="input-field">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </li>
            @elseif($signedIn)
                <li class="dropdown-user">
                    <div class="user-welcome dropdown-button" data-activates="dropdown-user-content"><span>{{ $user->username }}</span><span class="caret"><i class="fa fa-caret-down" aria-hidden="true"></i></span></div>
                    <div id="dropdown-user-content" class="user-drop dropdown-content prevent-def">
                        @if ($signedIn && $user->isAdmin())
                            <a href="/spa/create">Add Spa</a>
                            <a href="/adminviewusers">List Users</a>
                        @elseif($signedIn && $user->isSpaManager())
                            @foreach($user->managerOfSpa as $managed_spa)
                                <a href="/{{ $managed_spa->region_slug }}/{{ $managed_spa->city_slug }}/{{ $managed_spa->store_name_slug }}">Manage {{$managed_spa->store_name}}</a>
                            @endforeach
                        @endif
                        <a href="{{ url('favorite-spas') }}">Favorite Spas</a>
                        <a href="{{ url('my-ratings') }}">My Ratings</a>
                        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                        <a href="{{ route('auth.edit',$user->id)}}">Edit Avatar</a>
                    </div>
                </li>
            @endif
            <li class="menu-pop">
                <div class="hamburger">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </li>
        </ul>
        <form method="post" action="/search" enctype="multipart/form-data" id="search-dropdown" class="search-form dropdown-content prevent-def">
            {{ csrf_field() }}
            <label for="rating">Search for a spa</label>
            <input type="text" name="spaname">
            <button type="submit" class="btn btn-primary">Search!</button>
        </form>
    </div>

</div><!--/.nav-collapse -->
<div class="rate-message">
    <div class="contains cf">
        <h2>If you have been to any of the spas on our site, please sign up and leave a review, it's completely free. Thank You</h2>
    </div>
</div>