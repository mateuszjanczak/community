@extends("layouts.app")

@section("title")
- Settings
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    @yield("hero-title")
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="tabs">
                <ul>
                    <li><a href="{{route('settingsAvatar')}}">Avatar</a></li>
                    <li><a href="{{route('settingsPassword')}}">Password</a></li>
                    <li><a href="{{route('settingsEmail')}}">E-mail</a></li>
                </ul>
            </div>
            @yield("settings");
        </div>
    </section>
    <script type="text/javascript">
        $("#file-input").on("change", function(){
            $("#file-name").text($(this).prop('files')[0].name);
        });
    </script>
@endsection("content")
