<form action="{{ action('CommentController@editStore', $comment->id) }}" method="POST" class="form-comment">
    @csrf
    <article class="media">
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea class="textarea" name="content" placeholder="Add a post...">{{ $comment->content }}</textarea>
                </p>
            </div>
            <div class="field is-pulled-right">
                <p class="control">
                    <input id="{{$comment->id}}" type="button" class="button" value="Cancel" onclick="cancelComment(this)">
                    <input id="{{$comment->id}}" type="button" class="button" value="Edit" onclick="editCommentStore(this)">
                </p>
            </div>
        </div>
    </article>
</form>
