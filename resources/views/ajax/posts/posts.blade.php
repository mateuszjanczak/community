@foreach($posts as $post)
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
@endforeach
<input type="hidden" id="lastPostId" value="@if(sizeof($posts)) {{ $posts[sizeof($posts)-1]->id }} @endif">
