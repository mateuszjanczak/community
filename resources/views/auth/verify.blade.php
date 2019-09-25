@extends('layouts.app')

@section("title")
- Verify
@endsection

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Verify Your Email Address') }}
                </h1>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="box columns is-centered">
                <div class="column is-one-third">
                    @if (session('resent'))
                        <strong class="help is-danger is-size-5">{{ __('A fresh verification link has been sent to your email address.') }}</strong><br>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </section>
@endsection
