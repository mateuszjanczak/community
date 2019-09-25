<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store($id, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->userId = Auth::id();
        $comment->postId = $id;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('post', ['id' => $id]);
    }

    public function edit($id, CommentRepository $commentRepo, Request $request)
    {
        $comment = $commentRepo->find($id);

        if (empty($comment)) {
            return abort(404);
        }

        $this->authorize('your-comment', $comment);

        if ($request->ajax()) {
            return view('ajax.comments.edit', ['comment' => $comment]);
        }
    }

    public function editStore($id, CommentRepository $commentRepo, Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = $commentRepo->find($id);

        if (empty($comment)) {
            return abort(404);
        }

        $this->authorize('your-comment', $comment);

        $comment->content = $request->input('content');
        $comment->save();
    }

    public function editView($id, CommentRepository $commentRepo, Request $request)
    {
        $comment = $commentRepo->find($id);

        if (empty($comment)) {
            return abort(404);
        }

        if ($request->ajax()) {
            return view('ajax.comments.view', ['comment' => $comment]);
        }
    }

    public function delete($id, CommentRepository $commentRepo)
    {
        $comment = $commentRepo->find($id);

        if (empty($comment)) {
            return abort(404);
        }

        $this->authorize('your-comment', $comment);

        $comment->delete();

        return back();
    }
}
