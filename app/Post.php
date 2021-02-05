<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

    protected $fillable = [
        'title', 'description', 'image', 'author_id',
    ];
    protected $hidden = [
        'author_id', 'created_at','updated_at',
    ];
    //each post has many comments belongs to many users
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');

    }

    public function user()
    {
        return $this->belongsToMany(User::class,'comments')->withpivot('comment');
    }

    //each post belongs to one author
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
