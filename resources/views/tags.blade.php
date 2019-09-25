@extends("layouts.app")

@section("title")
- Tags
@endsection

@section("content")
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ __('Popular tags') }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container is-fluid">
            <div class="tags">
                @forelse($tags as $tag)
                    <span class="tag">{!! \App\Helpers\ParseTag::parseTag("#".$tag->name) !!}&nbsp;{{$tag->tags_post_count}}</span>
                @empty
                    No tags
                @endforelse
            </div>
        </div>
    </section>
@endsection
