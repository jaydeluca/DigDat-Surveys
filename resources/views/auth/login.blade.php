@extends('layouts.app')

@section('content')
    <section class="hero background-alternate">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div id="login" class="column is-5 is-offset-1">
                        <h1 class="title">
                            Login
                        </h1>
                        <div class="box">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="label" for="email">Email</label>
                                    <p class="control">
                                        <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="label" for="password">Password</label>
                                    <p class="control">
                                        <input id="password" type="password" class="input" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <p class="control">
                                    <label class="label"> <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me</label>
                                </p>
                                <br />

                                <button type="submit" id="login-btn" class="button is-fullwidth is-primary">Login</button>
                                <br />

                                <a id="forgot-btn" class="button is-fullwidth" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </form>
                        </div>
                    </div>

                    <div id="register" class="column is-5">
                        <div class="card">
                            <div class="card-content">
                                <h1 class="title">Need an Account?</h1>
                                <a href="{{ route('register') }}" class="button is-fullwidth is-primary">Register for free</a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
