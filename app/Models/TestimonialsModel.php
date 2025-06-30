<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialsModel extends Model
{
    protected $table = 'testimonials';

    protected $primaryKey = 'testimonialID';

    protected $fillable = [
        'testimonialID',
        'name',
        'position',
        'company_name',
        'testimonial_content',
        'testimonial_submitter_picture',
        'company_logo',
        'is_public',
    ];


    protected $casts = [
        'testimonialID' => 'string',
        'is_public' => 'boolean',
    ];
}
