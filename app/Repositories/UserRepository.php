<?php


namespace App\Repositories;

use App\Helpers\PrettyPaginator;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    // GET laravel.local/profile/{username}
    public function findByUsername($username)
    {
        return $this->model->where("username", "=", $username)->first();
    }

    // GET laravel.local/profile/{username}
    public function getUsers($page)
    {
        $temp = $this->model->orderBy("id", "desc")->get();

        return new PrettyPaginator($temp->forPage($page, 5), $temp->count(), 5, $page, ['path'=>url('users')]);
    }
}
