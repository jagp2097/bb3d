<?php

namespace bagrap;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'category_name', 'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }

}
