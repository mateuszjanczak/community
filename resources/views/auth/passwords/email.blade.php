@extends('layouts.app')

@section("title")
- Reset password
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Reset Password') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="box columns is-centered">
                <div class="column is-one-third">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        @if (session('status'))
                            <strong class="help is-danger is-size-5">{{ session('status') }}</strong><br>
                        @endif

                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email"
                                       class="input @error('email') is-danger @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}">
                                <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                                @error('email')
                                    <p class="help is-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <div class="columns is-mobile is-vcentered">
                                    <div class="column is-narrow">
                                        <button type="submit" class="button is-success">
                                            {{ __('Send Password Reset Link') }}
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
