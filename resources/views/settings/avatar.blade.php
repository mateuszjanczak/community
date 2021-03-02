@extends("settings.template")

@section("title")
- Settings - Avatar
@endsection

@section("hero-title")
    {{ __('Change avatar') }}
@endsection

@section("settings")
    <div class="box columns is-centered is-mobile">
        <div class="column is-narrow has-text-centered">
            <form action="{{route('settingsAvatarStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('status'))
                    <strong class="help is-danger is-size-5">{{ session('status') }}</strong><br>
                @endif
                <div class="field">
                    <img class="avatar" src="@if(Auth::user()->avatar) {{ secure_asset('avatar/'.Auth::user()->avatar) }} @else {{ secure_asset('avatar/default.jpg') }} @endif">
                </div>
                @error('avatar')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
                <div class="field">
                    <div class="file">
                        <label class="file-label has-name">
                            <input id="file-input" class="file-input" type="file" name="avatar" autofocus required>
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Choose a file...
                                </span>
                            </span>
                            <span id="file-name" class="file-name">
                                No file selected
                            </span>
                        </label>
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
    <script type="text/javascript">
        $("#file-input").on("change", function(){
            $("#file-name").text($(this).prop('files')[0].name);
        });
    </script>
@endsection("settings")
