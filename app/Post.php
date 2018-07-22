<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'content', 'file', 'file_type'];

    /**
     * Relationship with table 'categories'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany('App\Category', 'post_category');
    }

    /**
     * Relationship with table 'comments'
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany('App\Comment')->latest();
    }

    protected static function boot() {
        parent::boot();

        self::deleting(function($category) {
            $category->categories()->detach();
        });
    }
}
