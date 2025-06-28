<?php

namespace App\Livewire\CMS;

use Livewire\Component;
use App\Models\TestimonialsModel;

class TestimonialsList extends Component
{

    public $testimonials;

    public function mount(){

        $this->testimonials = TestimonialsModel::orderBy('created_at', 'desc')->get();
    }


    public function render()
    {
        return view('livewire.cms.testimonials-list');
    }
}
