<div class="post">
    <figure class="media-left" style="float: left">
        <p class="image is-64x64">
            <img class="avatar" src="@if($post->user->avatar) {{ asset('avatar/'.$post->user->avatar) }} @else {{ asset('avatar/default.jpg') }} @endif">
        </p>
    </figure>
    <div class="media-right" style="float: right">
        <span id="likes">{{ $post->likes }}</span>
    </div>
    <div id="details" class="content is-clearfix has-text-justified is-size-6 is-size-7-mobile">
        <p>
            <strong><a href="{{ route('profile', $post->user->username) }}">{{ $post->user->username }}</a></strong>
            <small> · <a href="{{ route('post', $post->id)."/".$post->short."/" }}">{{ \App\Helpers\Time::toTimeAgo($post->created_at) }}</a>@if($post->created_at != $post->updated_at) · Edited {{ \App\Helpers\Time::toTimeAgo($post->updated_at) }}@endif</small>
            <p style="white-space: pre-wrap;">{!! \App\Helpers\ParseTag::parse($post->content) !!}</p>
            @auth
                @can('your-post', $post)
                    <small id="controls" class="is-pulled-right"><a id="{{ $post->id }}" onclick="event.preventDefault(); replyPost(this)">Reply</a> · <a id="{{ $post->id }}" href="{{ action('PostController@edit', $post->id) }}" onclick="event.preventDefault(); editPost(this)">Edit</a> · <a id="{{ $post->id }}" href="{{ action('PostController@delete', $post->id) }}" onclick="event.preventDefault(); deletePost(this)">Delete</a></small>
                @else
                    <small id="controls" class="is-pulled-right"><a id="{{ $post->id }}" onclick="event.preventDefault(); likePost(this)" href="{{ route('likePost', $post->id) }}">@can('is-liked-post', $post) Unlike @else Like @endcan</a> · <a id="{{ $post->id }}" onclick="event.preventDefault(); replyPost(this)">Reply</a></small>
                @endcan
            @endauth
        </p>
    </div>
</div>
