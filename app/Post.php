<?php

namespace bagrap;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'post_author', 'post_title', 'post_title_slug', 'post_content', 'post_thumbnail',
        'post_description', 'post_published', 'post_category',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    public function scopeSearch($query, $search_query)
    {

        return $query->where('post_title', 'LIKE', "%{$search_query}%")
                     ->where('post_published', '=', '1');

    }

    public function excerptPost($postContent)
    {
        $pos = strpos($postContent, '<p>'); 
        $posFin = strpos($postContent, '</p>'); 

        $cont_slice = substr($postContent, $pos, $posFin); 

        return Str::words($cont_slice, 30, ' ...');
    }


}
