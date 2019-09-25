<?php

namespace App\Providers;

use App\Models\Like;
use App\Repositories\LikeRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('your-post', function ($user, $post) {
            return $user->id == $post->userId;
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->id == $post->userId;
        });

        Gate::define('like-post', function ($user, $post) {
            return $user->id != $post->userId;
        });

        Gate::define('your-comment', function ($user, $comment) {
            return $user->id == $comment->userId;
        });

        Gate::define('update-comment', function ($user, $comment) {
            return $user->id == $comment->userId;
        });

        Gate::define('like-comment', function ($user, $comment) {
            return $user->id != $comment->userId;
        });

        Gate::define('is-liked-post', function ($user, $post) {
            $likeRepo = new LikeRepository(new Like());
            $like = $likeRepo->findLikePost($post->id, $user->id);
            return !empty($like);
        });

        Gate::define('is-liked-comment', function ($user, $comment) {
            $likeRepo = new LikeRepository(new Like());
            $like = $likeRepo->findLikeComment($comment->id, $user->id);
            return !empty($like);
        });
        //
    }
}
