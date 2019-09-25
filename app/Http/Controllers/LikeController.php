<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Repositories\CommentRepository;
use App\Repositories\LikeRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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

    public function likePost($postId, PostRepository $postRepo, LikeRepository $likeRepo)
    {
        $post = $postRepo->find($postId);

        if (empty($post)) {
            return abort(404);
        }

        $this->authorize('like-post', $post);

        $userId = Auth::user()->id;

        $like = $likeRepo->findLikePost($postId, $userId);

        if (empty($like)) {
            $like = new Like();
            $like->postId = $postId;
            $like->userId = $userId;
            $like->save();

            $post->likes = $post->likes+1;
            $post->timestamps = false;
            $post->save();
        } else {
            $like->delete();

            $post->likes = $post->likes-1;
            $post->timestamps = false;
            $post->save();
        }
    }

    public function likePostView($postId, PostRepository $postRepo, Request $request)
    {
        $post = $postRepo->find($postId);

        if (empty($post)) {
            return abort(404);
        }

        if ($request->ajax()) {
            return $post->likes;
        }

        return redirect()->route('post', ['id' => $post->id, 'post' => $post->slug]);
    }

    public function likeComment($commentId, CommentRepository $commentRepo, LikeRepository $likeRepo)
    {
        $comment = $commentRepo->find($commentId);

        if (empty($comment)) {
            return abort(404);
        }

        $this->authorize('like-comment', $comment);

        $userId = Auth::user()->id;

        $like = $likeRepo->findLikeComment($commentId, $userId);

        if (empty($like)) {
            $like = new Like();
            $like->commentId = $commentId;
            $like->userId = $userId;
            $like->save();

            $comment->likes = $comment->likes+1;
            $comment->timestamps = false;
            $comment->save();
        } else {
            $like->delete();

            $comment->likes = $comment->likes-1;
            $comment->timestamps = false;
            $comment->save();
        }
    }

    public function likeCommentView($commentId, CommentRepository $commentRepo, Request $request)
    {
        $comment = $commentRepo->find($commentId);

        if (empty($comment)) {
            return abort(404);
        }

        if ($request->ajax()) {
            return $comment->likes;
        }
    }
}
