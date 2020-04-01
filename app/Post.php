<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'src', 'category1', 'category2', 'likes'];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
