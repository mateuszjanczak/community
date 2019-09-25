<?php

namespace App\Repositories;

use App\Models\TagsPost;

class TagsPostsRepository extends BaseRepository
{
    public function __construct(TagsPost $model)
    {
        $this->model = $model;
    }

    // POST laravel.local/post/edit/{id}
    public function findByPostId($id)
    {
        //return $this->model->where('postId', '=', $id)->get();
        return $this->model->whereHas('post', function ($query) use($id) {
            $query->where('id', '=', $id);
        })->get();
    }
}
