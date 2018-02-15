
<!DOCTYPE html>
<html lang="eng">
    <head>
        @include('head')
    </head>
    <body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MPVG6ZZ"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <div id="app">
            <!-- Google Tag Manager (noscript) -->
            <!-- End Google Tag Manager (noscript) -->
                {{--<div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Spa Pal</a>
                </div>--}}
                @include('header')
                @include('sidebar')
                @yield('content')
        </div>
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="modal-close close">&times;</span>
                <h1>Register</h1>
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
                                                    <img src="/img/avatars/1.png">
                                                </div>
                                                <div class="select-img" data-value="2.png">
                                                    <img src="/img/avatars/2.png">
                                                </div>
                                                <div class="select-img" data-value="3.png">
                                                    <img src="/img/avatars/3.png">
                                                </div>
                                                <div class="select-img" data-value="4.png">
                                                    <img src="/img/avatars/4.png">
                                                </div>
                                                <div class="select-img" data-value="5.png">
                                                    <img src="/img/avatars/5.png">
                                                </div>
                                                <div class="select-img" data-value="6.png">
                                                    <img src="/img/avatars/6.png">
                                                </div>
                                                <div class="select-img" data-value="7.png">
                                                    <img src="/img/avatars/7.png">
                                                </div>
                                                <div class="select-img" data-value="8.png">
                                                    <img src="/img/avatars/8.png">
                                                </div>
                                                <div class="select-img" data-value="9.png">
                                                    <img src="/img/avatars/9.png">
                                                </div>
                                                <div class="select-img" data-value="10.png">
                                                    <img src="/img/avatars/10.png">
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
        </div>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-38269986-8', 'auto');
            ga('send', 'pageview');

        </script>
        <script src="/js/app.js"></script>
        <script src="/js/materialize.min.js"></script>
        <script src="/js/libs.js"></script>
        <script>
            $('.modal-close').on('click', function (event) {
                $('#myModal').removeClass('modal-opened');
            });
            $( document ).on( 'keydown', function ( e ) {
                if ( e.keyCode === 27 ) { // ESC
                    $('#myModal').removeClass('modal-opened');
                }
            });
            $('.reg-btn').on('click', function (event) {
                $('#myModal').toggleClass('modal-opened');
            });
        </script>
        @if(Auth::user())
            <script>
                var loggedIn = true;
            </script>
        @else
            <script>
                var loggedIn = false;
            </script>
        @endif
            <script>
                if (loggedIn != true){
                    $('.panel-footer span a').on('click', function (event) {
                        event.preventDefault();
                        swal({
                            title: "Sorry",
                            text: "You must be signed in to add spas to your favourites",
                            type: "warning",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    });
                }
            </script>
        @yield('scripts.footer')

        @include('flash')
    </body>
</html>
