<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSSlides extends Model
{
    protected $table = 'cms_slides';
    protected $primaryKey = 'slideID';

    protected $fillable = ['slideID', 'title', 'subtitle', 'description', 'is_public'];


    protected $casts = ['slideID' => 'string', 'is_public' => 'boolean'];
}
