<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tagId', 'postId'
    ];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tagId');
    }


}
