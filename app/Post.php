<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'content', 'file'];

    public function categories() {
        return $this->belongsToMany('App\Category', 'post_category');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
