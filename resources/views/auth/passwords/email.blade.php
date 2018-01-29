 @extends('layouts.app')

@section('content')
    <section class="hero background-alternate">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-6 is-offset-3">
                        <h1 class="title">
                            Reset Password
                        </h1>

                        <div class="box">
                            @if (session('status'))
                                <div class="message is-success">
                                    <span class="message-header">{{ session('status') }}</span>
                                </div>
                            @endif

                            @if ($errors->has('invalid'))
                                    <div class="message is-error">
                                        <span class="message-header">{{$errors->first('invalid')}}</span>
                                    </div>
                            @endif
                            <form role="form" method="POST" role="form" method="POST"
                                  action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                    <p class="control">
                                        <input id="email" type="email" class="input" name="email" required
                                               autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="submit" type="submit" class="button is-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
