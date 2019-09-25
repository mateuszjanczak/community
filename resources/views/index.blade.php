@extends("layouts.app")

@section("title")
- Home
@endsection

@section("content")
<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                {{ __('Community') }}
            </h1>
        </div>
    </div>
</section>
<section class="section">
    <div class="container is-fluid">
        <div class="tabs is-centered is-boxed">
            <ul>
                <li class="is-active">
                    <a>
                        <span class="icon is-small"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
                        <span>Posts</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span>
                        <span>Pictures</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span>
                        <span>Music</span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span>
                        <span>Videos</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="columns">
            <div class="column is-four-fifths">
                <div id="posts" class="inf-scroll box">
                    @auth
                        <form action="{{ action('PostController@store') }}" method="POST">
                            @csrf
                            <article class="media">
                                <div class="media-content">
                                    <div class="field">
                                        <p class="control">
                                            <textarea class="textarea" name="content" placeholder="Add a post..."></textarea>
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
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    let currentPage =  "{{ $posts->nextPageUrl() }}"+"?post=";
    let lastPostId = @if(sizeof($posts) && $posts->hasMorePages()) {{ $posts[sizeof($posts)-1]->id }} @else "" @endif;
    let nextPage = currentPage+lastPostId;
    let loadingUrl = "{{ asset('loading.svg') }}";

    $(document).ready(function() {
        $(window).scroll(fetchPosts);

        function fetchPosts() {
            let page = $('.inf-scroll').data('next-page');
            if (page !== null) {
                clearTimeout($.data(this, "scrollCheck"));
                $.data(this, "scrollCheck", setTimeout(function() {
                    let scroll_position_for_posts_load = $(window).height() + $(window).scrollTop() + 100;

                    if (scroll_position_for_posts_load >= $(document).height()) {

                        if (!lastPostId) {
                            return;
                        }

                        if($("#pagination").length){ $("#pagination").remove();}

                        if (!$("#loading").length) {
                            $("#posts").append(
                                $('<div>', {
                                    'id': 'loading',
                                    'class': 'columns is-mobile is-centered'
                                }).append(
                                    $('<div>', {
                                        'class': 'column is-narrow'
                                    }).append(
                                        $('<img>', {
                                            'src': loadingUrl
                                        })
                                    )
                                )
                            )
                        }

                        console.log("Loading " + nextPage);

                        $.ajax({
                            url: nextPage,
                            method: "GET",
                            dataType: "html"
                        })
                            .done(function(data) {
                                console.log("Success");
                                $("#posts").append(data);
                                lastPostId = $("#lastPostId").val().replace(/\s/g, '');
                                if (lastPostId) {
                                    nextPage = currentPage+lastPostId;
                                }
                                $("#lastPostId").remove();
                                $("#loading").remove();
                            })
                            .fail(function() {
                                console.log("Error");
                            });
                    }
                }, 350))
            }
        }
    })
</script>
@endsection
