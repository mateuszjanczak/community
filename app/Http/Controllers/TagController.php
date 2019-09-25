<?php

namespace App\Http\Controllers;


use App\Repositories\PostRepository;
use App\Repositories\TagRepository;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function tag($name, PostRepository $postRepo, $page = 1)
    {
        $posts = $postRepo->getTagPosts($name, $page);

        return view('tag', ['posts' => $posts, 'tagname' => $name]);
    }

    public function tags(TagRepository $tagRepo)
    {
        $tags = $tagRepo->getPopularTags();

        return view('tags', ['tags' => $tags]);
    }
}
