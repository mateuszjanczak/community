@extends("layouts.app")

@section("title")
- Post - {!! str_replace('-', ' ', $post->short) !!}
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Post') }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container is-fluid">
            <div class="columns">
                <div class="column is-four-fifths">
                    <div class="box">
                        <article id="post-{{ $post->id }}" class="media">
                            <div class="media-content">
                                @include('layouts.posts.post')
                                @foreach($post->postsComments as $comment)
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
