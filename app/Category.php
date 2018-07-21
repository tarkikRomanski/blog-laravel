<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Relationship with table 'posts'
     * @return mixed
     */
    public function posts() {
        return $this->belongsToMany('App\Post', 'post_category');
    }
}
