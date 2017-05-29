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

            <!-- Guest Nav -->
            @if (Auth::guest())
                <a class="nav-item is-tab" href="/surveys">Browse Surveys</a>
                <a class="nav-item is-tab" href="{{ route('login') }}">Login</a>
                <a class="nav-item is-tab" href="{{ route('register') }}">Register</a>
                <a class="nav-item is-tab is-hidden-tablet" href="/surveys/create">Create a Survey</a>
                <a class="button c-btn c-btn--primary is-hidden-custom" href="/surveys/create">Create a Survey</a>
            @else
                <a class="button c-btn c-btn--primary is-hidden-custom" href="/surveys/create">Create a Survey</a>

                <div class="has-dropdown my-account is-hidden-custom">
                    <input type="checkbox" id="ch1">   <!-- note: id -->
                    <label class="button" for="ch1">My Account</label>  <!-- note: for -->
                    <div class="dropdown box">
                        <ul>
                            <li>
                                <a href="/home" class="nav-item">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="nav-item"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
    </div>
</nav>