<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
      (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
          }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'UA-84556527-2', 'auto');
      ga('send', 'pageview');

    </script>

</head>
<body>
<div id="app">

    <nav class="nav has-shadow" id="top">
        <div class="container">
            <div class="nav-left">

                <!-- Logo -->
                <a class="nav-item logo" href="{{ url('/') }}">
                    @icon('digdat-text-logo', 'header-logo')
                </a>

            </div>
            <label for="menu-toggle" class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <input type="checkbox" id="menu-toggle" class="is-hidden"/>

            <div class="nav-right nav-menu">

                @if (Auth::guest())
                    <a class="nav-item is-tab" href="/surveys">Browse Surveys</a>
                    <a class="nav-item is-tab" href="{{ route('login') }}">Login</a>
                    <a class="nav-item is-tab" href="{{ route('register') }}">Register</a>
                    <a class="nav-item is-tab is-hidden-tablet" href="/surveys/create">Create a Survey</a>
                    <a class="button c-btn c-btn--primary is-hidden-custom" href="/surveys/create">Create a Survey</a>
                @else
                    <p class="nav-item">
                        {{ Auth::user()->name }}
                    </p>

                    <a href="{{ route('logout') }}" class="nav-item is-tab"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<footer class="footer">
    <div class="container">
        <div class="content has-text-centered">
            <p>
                <strong>DigDat Surveys</strong> a Free Survey Tool
            </p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
