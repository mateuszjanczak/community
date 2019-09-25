@extends("settings.template")

@section("title")
    - Settings - Email
@endsection

@section("hero-title")
    {{ __('Change email') }}
@endsection("title")

@section("settings")
    <div class="box columns is-centered is-mobile">
        <div class="column is-narrow has-text-centered">
            <form method="POST" action="{{ route('settingsEmailStore') }}">
                @csrf
                @if (session('status'))
                    <strong class="help is-danger is-size-5">{{ session('status') }}</strong><br>
                @endif
                <div class="field">
                    <strong class="help is-info is-size-6">Current email address:</strong>
                    <p class="help is-info is-size-6">{{Auth::user()->email}}</p>
                </div>
                <div class="field">
                    <div class="control has-icons-left">
                        <input id="current_password" type="password" class="input @error('current_password') is-danger @enderror" name="current_password" placeholder="{{ __('Current password') }}" autofocus required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                        @error('current_password')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <div class="control has-icons-left has-icons-right">
                        <input id="email" type="email" class="input @error('email') is-danger @enderror" type="email" name="email" placeholder="{{ __('New email address') }}" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                        @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field is-grouped is-grouped-centered">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            Save
                        </button>
                    </p>
                    <p class="control">
                        <a href="{{ route('home') }}" class="button is-light">
                            Cancel
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection("settings")
