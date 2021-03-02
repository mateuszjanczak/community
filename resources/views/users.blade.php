@extends("layouts.app")

@section("title")
- Users
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Recently registered users') }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            @forelse($users as $user)
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <img class="avatar" src="@if($user->avatar) {{ secure_asset('avatar/'.$user->avatar) }} @else {{ secure_asset('avatar/default.jpg') }} @endif">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">{{ $user->username }}</p>
                                <p class="subtitle is-6">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="content">
                            <time>joined {{ \App\Helpers\Time::toTimeAgo($user->created_at) }}</time>
                        </div>
                    </div>
                </div>
            @empty
                No users
            @endforelse
            {{ $users->links() }}
        </div>
    </section>
@endsection
