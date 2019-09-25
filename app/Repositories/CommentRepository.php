<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    // GET laravel.local/hot && laravel.local/hot/page/{page}
    public function getHotComments()
    {
        return $this->model->groupBy("postId")->orderBy("likes", "desc")->take(100)->get();
    }
}
