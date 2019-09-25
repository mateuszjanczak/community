@extends("layouts.app")

@section("title")
- Hot posts
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('All hot posts') }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-four-fifths">
                    <div id="posts" class="box">
                        @auth
                            <form action="{{ action('PostController@store') }}" method="POST">
                                @csrf
                                <article class="media">
                                    <div class="media-content">
                                        <div class="field">
                                            <p class="control">
                                                <textarea class="textarea" name="content"
                                                          placeholder="Add a post..."></textarea>
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
                            <hr>
                        @endauth

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
            </div>
        </div>
    </section>
@endsection
