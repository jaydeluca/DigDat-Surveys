@extends('layouts.app')

@section('content')
    <section class="hero is-fullheight is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title">
                            Login
                        </h1>
                        <div class="box">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="label">Email</label>
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
                                    <label class="label">Password</label>
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

                                <button type="submit" class="button is-fullwidth is-primary">Login</button>
                                <br />

                                <a class="button is-fullwidth" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
