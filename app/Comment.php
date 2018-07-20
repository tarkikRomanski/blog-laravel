<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = ['author', 'content', 'post_id', 'create_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->create_at = $model->freshTimestamp();
        });
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
