<!DOCTYPE html>
<html class="has-navbar-fixed-top">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Community @yield("title")</title>
    <link href="{{ asset('css/bulma/bulma.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/fontawesome/all.js') }}"></script>
    <script src="{{ asset('js/pulltorefresh/index.umd.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jscroll/jquery.jscroll.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<nav class="navbar is-light is-fixed-top">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ action('HomeController@index') }}">
            <img height="70" src="{{ asset('logo.png') }}">
        </a>

        <a class="navbar-burger burger">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ action('HomeController@index') }}">
                Community
            </a>

            <a class="navbar-item" href="{{ action('HomeController@hot') }}">
                Hot
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    More
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="{{ action('TagController@tags') }}">
                        Tags
                    </a>
                    <a class="navbar-item" href="{{ action('HomeController@users') }}">
                        Users
                    </a>
                    <a class="navbar-item">
                        Contact
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                        Report an issue
                    </a>
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @auth
                        <a href="#" class="button is-family-primary">
                            <i class="far fa-envelope"></i>
                        </a>
                        <a href="#" class="button is-family-primary">
                            <i class="far fa-bell"></i>
                        </a>

                        <a href="{{ route('settings') }}" class="button is-family-primary">
                            {{ __('Settings') }}
                        </a>
                        <a class="button is-family-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="button is-family-primary">
                            <strong>{{ __('Sign up') }}</strong>
                        </a>
                        <a href="{{ route('login') }}" class="button is-family-primary">
                            {{ __('Log in') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

@yield("content")

</body>

</html>
