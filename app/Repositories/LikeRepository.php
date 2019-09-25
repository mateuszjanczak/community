<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository extends BaseRepository
{
    public function __construct(Like $model)
    {
        $this->model = $model;
    }

    // POST laravel.local/post/like/{id}
    public function findLikePost($postId, $userId)
    {
        return $this->model->where('postId', '=', $postId)->where('userId', '=', $userId)->first();
    }

    // POST laravel.local/comment/like/{id}
    public function findLikeComment($commentId, $userId)
    {
        return $this->model->where('commentId', '=', $commentId)->where('userId', '=', $userId)->first();
    }
}
