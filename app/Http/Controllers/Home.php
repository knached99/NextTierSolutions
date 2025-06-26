<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CMSModel;
use App\Models\CMSSlides;
use App\Models\Services;

class Home extends Controller
{
    public function landing(){
        
        $cmsContent = CMSModel::all()->keyBy('region'); // Maps collection by 'region'
        $slides = CMSSlides::all();
        $services = Services::all();

        return view('landing', [
            'cmsContent' => $cmsContent,
            'slides' => $slides,
            'services' => $services
        ]);
    }

    public function contactPage(){
        return view('contact');
    }
}
