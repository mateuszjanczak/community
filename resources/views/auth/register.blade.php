@extends('layouts.app')

@section("title")
- Register
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Create your account') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="box columns is-centered">
                <div class="column is-one-third">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="username" type="text" class="input @error('username') is-danger @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="{{ __('Username') }}">
                                <span class="icon is-small is-left">
                                  <i class="fas fa-user"></i>
                                </span>
                                @error('username')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email" class="input @error('email') is-danger @enderror" type="email" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}" >
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                @error('email')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
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
                            <div class="control has-icons-left">
                                <input id="password-confirm" type="password" class="input @error('password') is-danger @enderror" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}">
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
                                <div class="columns is-mobile is-vcentered">
                                    <div class="column is-narrow">
                                        <button type="submit" class="button is-success">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
