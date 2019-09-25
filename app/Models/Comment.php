<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postId', 'userId', 'content', 'likes'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
