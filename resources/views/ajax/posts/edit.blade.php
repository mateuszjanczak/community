<form action="{{ action('PostController@editStore', $post->id) }}" method="POST" class="form-post">
    @csrf
    <article class="media">
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea class="textarea" name="content" placeholder="Add a post...">{{ $post->content }}</textarea>
                </p>
            </div>
            <div class="field is-pulled-right">
                <p class="control">
                    <input id="{{$post->id}}" type="button" class="button" value="Cancel" onclick="cancelPost(this)">
                    <input id="{{$post->id}}" type="button" class="button" value="Edit" onclick="editPostStore(this)">
                </p>
            </div>
        </div>
    </article>
</form>
