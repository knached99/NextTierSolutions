<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMSModel;
use App\Models\CMSSlides;
use App\Models\Services;
use App\Models\TestimonialsModel;
use App\Models\ArticlesModel;

class Home extends Controller
{
    public function landing(){
        
        $cmsContent = CMSModel::all()->keyBy('region'); // Maps collection by 'region'
        $slides = CMSSlides::all();
        $services = Services::all();
        $testimonials = TestimonialsModel::select('name', 'position', 'company_name', 'testimonial_content', 'testimonial_submitter_picture', 'company_logo', 'created_at')->orderBy('created_at', 'desc')->get();
        $articles = ArticlesModel::select('title', 'content', 'slug', 'article_post_image_path')->orderBy('created_at')->get();

        return view('landing', [
            'cmsContent' => $cmsContent,
            'slides' => $slides,
            'services' => $services,
            'testimonials' => $testimonials,
            'articles' => $articles,
        ]);
    }


    public function contactPage(){
        return view('contact');
    }
}
