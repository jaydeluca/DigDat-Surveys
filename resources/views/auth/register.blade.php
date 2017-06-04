@extends('layouts.app')

@section('content')
    <section class="hero background-alternate">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3">
                        <h1 class="title">
                            Register
                        </h1>
                        <div class="box">

                            <form role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="label">Name</label>
                                    <p class="control">
                                        <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    <label class="label">Public URL for your Surveys</label>
                                    <p style="margin: 10px 5px;">If you create surveys, they will be located at: digdatsurveys.com/your-public-url/survey-name</p>
                                    <p class="control">
                                        <input id="slug"
                                               placeholder="Ex: joes-surveys"
                                               type="text"
                                               class="input"
                                               name="slug"
                                               value="{{ old('slug') }}"
                                               required autofocus>

                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="label">E-Mail Address</label>

                                    <p class="control">
                                        <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required>

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

                                <div class="form-group">
                                    <label class="label">Confirm Password</label>

                                    <p class="control">
                                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                                    </p>
                                </div>
                                <br />
                                <button type="submit" class="button is-fullwidth is-primary">Register</button>
                                <br />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
