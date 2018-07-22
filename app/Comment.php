<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['author', 'content', 'post_id', 'created_at'];

    /**
     * Has updated to set create date automate
     * @override
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    /**
     * Relationship with table 'posts'
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo('App\Post');
    }
}
