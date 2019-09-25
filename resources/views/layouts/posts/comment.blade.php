<div class="comment">
    <figure class="media-left" style="float: left;">
        <p class="image is-48x48">
            <img class="avatar" src="@if($comment->user->avatar) {{ asset('avatar/'.$comment->user->avatar) }} @else {{ asset('avatar/default.jpg') }} @endif">
        </p>
    </figure>
    <div class="media-right" style="float: right">
        <span id="likes">{{ $comment->likes }}</span>
    </div>
    <div id="details" class="content has-text-justified is-size-6 is-size-7-mobile">
        <p>
            <strong><a href="{{ route('profile', $comment->user->username) }}">{{ $comment->user->username }}</a></strong>
            <small> · <a href="{{ route('post', $post->id)."/".$post->short."/#comment-".$comment->id }}">{{ \App\Helpers\Time::toTimeAgo($comment->created_at) }}</a>@if($comment->created_at != $comment->updated_at) · Edited {{ \App\Helpers\Time::toTimeAgo($comment->updated_at) }}@endif</small>
            <p style="white-space: pre-wrap;">{!! \App\Helpers\ParseTag::parseTag($comment->content) !!}</p>
            @auth
                @can('your-comment', $comment)
                    <small id="controls" class="is-pulled-right"><a id="{{ $comment->id }}" href="{{ action('CommentController@edit', $comment->id) }}" onclick="event.preventDefault(); editComment(this)">Edit</a> · <a id="{{ $comment->id }}" href="{{ action('CommentController@delete', $comment->id) }}" onclick="event.preventDefault(); deleteComment(this)">Delete</a></small>
                @else
                    <small id="controls" class="is-pulled-right"><a id="{{ $comment->id }}" onclick="event.preventDefault(); likeComment(this)" href="{{ route('likeComment', $comment->id) }}">@can('is-liked-comment', $comment) Unlike @else Like @endcan</a> · <a id="{{ $comment->id }}" onclick="event.preventDefault(); replyComment(this)">Reply</a></small>
                @endcan
            @endauth
        </p>
    </div>
</div>

