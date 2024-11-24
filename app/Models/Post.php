<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'thumbnail',
        'is_draft'
    ];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // bookmark
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
