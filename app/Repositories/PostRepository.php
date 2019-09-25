<?php

namespace App\Repositories;

use App\Helpers\PrettyPaginator;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    // GET laravel.local/ && laravel.local/page/{page}
    public function getIndexPosts($page)
    {
        $temp = $this->model->orderBy("id", "desc")->get();

        return new PrettyPaginator($temp->forPage($page, 5), $temp->count(), 5, $page, ['path'=>url('')]);
    }

    // AJAX laravel.local/?post={id} && laravel.local/page/{page}?post={id}
    public function getIndexPostsWithOffset($offset)
    {
        return $this->model->where("id", "<", $offset)->orderBy("id", "desc")->take(5)->get();
    }

    // GET laravel.local/hot && laravel.local/hot/page/{page}
    public function getHotPosts()
    {
        return $this->model->orderBy("likes", "desc")->take(100)->get();
    }

    // GET laravel.local/profile/{username} && laravel.local/profile/{username}/page/{page}
    public function getProfilePosts($userId, $page, $username)
    {
        //$temp = $this->model->where("userId", "=", $userId)->orderBy("id", "desc")->get();

        $temp = $this->model->whereHas('user', function ($query) use($userId) {
            $query->where('id', '=', $userId);
        })->orderBy("id", "desc")->get();

        return new PrettyPaginator($temp->forPage($page, 5), $temp->count(), 5, $page, ['path'=>url('profile/'.$username)]);
    }

    // GET laravel.local/tag/{tagname} && laravel.local/tag/{tagname}/page/{page}
    public function getTagPosts($name, $page)
    {
        $temp = $this->model->whereHas('tags_post', function ($query) use($name) {
            $query->whereHas('tag', function ($query) use($name) {
                $query->where('name', '=', $name);
            });
        })->orderBy("id", "desc")->get();

        return new PrettyPaginator($temp->forPage($page, 5), $temp->count(), 5, $page, ['path'=>url('tag/'.$name)]);
    }
}
