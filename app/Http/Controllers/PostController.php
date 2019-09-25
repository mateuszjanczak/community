<?php

namespace App\Http\Controllers;

use App\Helpers\ParseTag;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagsPost;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Repositories\TagsPostsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function post($id, PostRepository $postRepo, $slug = null)
    {
        $post = $postRepo->find($id);

        if (empty($post)) {
            return abort(404);
        }

        if ($slug != $post->short) {
            return redirect()->route('postSlug', ['id' => $id, 'slug' => $post->short]);
        }

        return view('post', ['post' => $post]);
    }

    public function store(TagRepository $tagRepo, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post = new Post();
        $post->userId = Auth::id();
        $post->short = Str::slug($request->input('content'));
        $post->content = $request->input('content');
        $post->save();

        $string = $request->input('content');
        $this->tagStore($string, $post->id, $tagRepo);

        return back();
    }

    private function tagStore($string, $postId, TagRepository $tagRepo)
    {
        preg_match_all('/\B(\#[a-zA-Z]+\b)(?!;)/', $string, $matches);

        $matches = collect($matches[0])->unique();

        foreach ($matches as $match) {
            $tagname = substr($match, 1);
            $tag = $tagRepo->findByName($tagname);

            if (empty($tag)) {
                $tag = new Tag();
                $tag->name = $tagname;
                $tag->save();
            }

            $tagsPosts = new TagsPost();
            $tagsPosts->tagId = $tag->id;
            $tagsPosts->postId = $postId;
            $tagsPosts->save();
        }
    }

    private function tagDelete($postId, TagsPostsRepository $tagsPostsRepo)
    {
        $tagsPosts = $tagsPostsRepo->findByPostId($postId);
        foreach ($tagsPosts as $tagsPost) {
            $tagsPost->delete();
        }
    }

    public function edit($id, PostRepository $postRepo, Request $request)
    {
        $post = $postRepo->find($id);

        if (empty($post)) {
            return abort(404);
        }

        $this->authorize('your-post', $post);

        if ($request->ajax()) {
            return view('ajax.posts.edit', ['post' => $post]);
        }

        return redirect()->route('post', ['id' => $post->id, 'slug' => $post->slug]);
    }

    public function editStore($id, PostRepository $postRepo, TagRepository $tagRepo, TagsPostsRepository $tagsPostsRepo, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post = $postRepo->find($id);

        if (empty($post)) {
            return abort(404);
        }

        $this->authorize('your-post', $post);

        $this->tagDelete($post->id, $tagsPostsRepo);

        $post->content = $request->input('content');
        $post->save();

        $string = $request->input('content');
        $this->tagStore($string, $post->id, $tagRepo);

        return redirect()->route('post', ['id' => $post->id, 'slug' => $post->slug]);
    }

    public function editView($id, PostRepository $postRepo, Request $request)
    {
        $post = $postRepo->find($id);

        if (empty($post)) {
            return abort(404);
        }

        if ($request->ajax()) {
            return view('ajax.posts.view', ['post' => $post]);
        }

        return redirect()->route('post', ['id' => $post->id, 'slug' => $post->slug]);
    }

    public function delete($id, PostRepository $postRepo)
    {
        $post = $postRepo->find($id);

        if (empty($post)) {
            return abort(404);
        }

        $this->authorize('your-post', $post);
        $post->delete();
    }
}
