<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesModel extends Model
{

    protected $table = 'articles';
    protected $primaryKey = 'articleID';

    protected $fillable = [
        'articleID',
        'title',
        'slug',
        'content',
        'article_post_image_path',
        'is_public'
    ];

    protected $casts = ['articleID' => 'string', 'is_public' => 'boolean'];
}
