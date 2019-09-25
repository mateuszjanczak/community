<?php

namespace App\Http\Controllers;

use App\Helpers\PrettyPaginator;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class HomeController extends Controller
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

    public function index(PostRepository $postRepo, Request $request, $page = 1)
    {
        if ($request->ajax()) {
            $posts = $postRepo->getIndexPostsWithOffset($request->post);
            return view('ajax.posts.posts', ['posts' => $posts]);
        }

        $posts = $postRepo->getIndexPosts($page);

        return view('index', ['posts' => $posts]);
    }

    public function hot(PostRepository $postRepo, CommentRepository $commentRepo, $page = 1)
    {
        $posts = $postRepo->getHotPosts();
        $comments = $commentRepo->getHotComments();

        $temp = collect();

        foreach ($posts as $post) {
            $temp->add([
                "likes" => $post->likes,
                "post" => $post
            ]);
        }

        foreach ($comments as $comment) {
            $temp->add([
                "likes" => $comment->likes,
                "post" => $comment->post
            ]);
        }

        $temp = $temp->sortByDesc('likes')->unique('post');

        $data = collect();
        foreach ($temp as $value) {
            $data->add($value['post']);
        }

        $data = $data->take(100);

        $posts = new PrettyPaginator($data->forPage($page, 10), $data->count(), 10, $page, ['path' => url('hot')]);

        return view('hot', ['posts' => $posts]);
    }

    public function users(UserRepository $userRepo, $page = 1)
    {
        $users = $userRepo->getUsers($page);

        return view('users', ['users' => $users]);
    }
}
