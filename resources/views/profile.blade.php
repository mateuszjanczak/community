@extends("layouts.app")

@section("title")
- Profile {{ '@'.$user->username }}
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Profile') }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="card">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img class="avatar" src="@if($user->avatar) {{ asset('avatar/'.$user->avatar) }} @else {{ asset('avatar/default.jpg') }} @endif">
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
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="box">
                @forelse ($posts as $post)
                    <article id="post-{{ $post->id }}" class="media">
                        <div class="media-content">
                            @include('layouts.posts.post')
                            @foreach($post->postsHotComments->sortBy('created_at') as $comment)
                                <article id="comment-{{$comment->id}}" class="m-l-25 media">
                                    <div class="media-content">
                                        @include('layouts.posts.comment')
                                    </div>
                                </article>
                            @endforeach
                            @auth
                                <form action="{{ action('CommentController@store', $post->id) }}" method="POST" class="reply-post" hidden>
                                    @csrf
                                    <article class="media">
                                        <div class="media-content">
                                            <div class="field">
                                                <p class="control">
                                                    <textarea class="textarea" name="content" placeholder="Add a comment..."></textarea>
                                                </p>
                                            </div>
                                            <div class="field is-pulled-right">
                                                <p class="control">
                                                    <input type="submit" class="button" value="Send">
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                </form>
                            @endauth
                        </div>
                    </article>
                @empty
                    <p>No posts</p>
                @endforelse
            </div>
            {{ $posts->links() }}
        </div>
    </section>

@endsection("content")
