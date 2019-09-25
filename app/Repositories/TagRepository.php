<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    // POST laravel.local/post/{id} && laravel.local/post/edit/{id}
    public function findByName($name)
    {
        return $this->model->where("name", "=", $name)->first();
    }

    // GET laravel.local/tag/{tagname} && laravel.local/tag/{tagname}/page/{page}
    public function getPopularTags()
    {
        return $this->model->withCount('tags_post')->orderBy('tags_post_count', 'desc')->get();
    }
}
