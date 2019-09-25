<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'content', 'likes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function postsComments()
    {
        return $this->hasMany(Comment::class, 'postId');
    }

    public function postsHotComments()
    {
        return $this->hasMany(Comment::class, 'postId')->orderBy('likes', 'desc')->take(2);
    }

    public function tags_post()
    {
        return $this->hasMany(TagsPost::class, 'postId');
    }

}
