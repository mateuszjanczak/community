@extends('layouts.app')

@section("title")
- Login
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Sign in') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="box columns is-centered">
                <div class="column is-one-third">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="login" type="text"
                                       class="input {{ $errors->has('username') || $errors->has('email') ? ' is-danger' : '' }}"
                                       name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="{{ __('Username or Email') }}">
                                <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                                @if ($errors->has('username') || $errors->has('email'))
                                    <p class="help is-danger">{{ $errors->first('username') ?: $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required placeholder="{{ __('Password') }}">
                                <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                                @error('password')
                                     <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <div class="columns is-mobile is-vcentered">
                                    <div class="column is-narrow">
                                        <button type="submit" class="button is-success">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="column is-narrow">
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
